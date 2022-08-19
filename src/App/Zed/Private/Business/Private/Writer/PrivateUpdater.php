<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Writer;

use App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface;
use App\Zed\Private\Business\Private\Validator\PrivateValidatorInterface;
use App\Zed\Private\Persistence\PrivateEntityManagerInterface;
use ArrayObject;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\PrivateCollectionRequestTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class PrivateUpdater implements PrivateUpdaterInterface
{
    use TransactionTrait;

    /**
     * @var \App\Zed\Private\Persistence\PrivateEntityManagerInterface
     */
    protected PrivateEntityManagerInterface $privateEntityManager;

    /**
     * @var \App\Zed\Private\Business\Private\Validator\PrivateValidatorInterface
     */
    protected PrivateValidatorInterface $privateValidator;

    /**
     * @var \App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface
     */
    protected PrivateIdentifierBuilderInterface $privateIdentifierBuilder;

    /**
     * @var array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface>
     */
    protected array $privatePreUpdatePlugins;

    /**
     * @var array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface>
     */
    protected array $privatePostUpdatePlugins;

    /**
     * @param \App\Zed\Private\Persistence\PrivateEntityManagerInterface $privateEntityManager
     * @param \App\Zed\Private\Business\Private\Validator\PrivateValidatorInterface $privateValidator
     * @param \App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface $privateIdentifierBuilder
     * @param array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface> $privatePreUpdatePlugins
     * @param array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface> $privatePostUpdatePlugins
     */
    public function __construct(
        PrivateEntityManagerInterface $privateEntityManager,
        PrivateValidatorInterface $privateValidator,
        PrivateIdentifierBuilderInterface $privateIdentifierBuilder,
        array $privatePreUpdatePlugins,
        array $privatePostUpdatePlugins
    ) {
        $this->privateEntityManager = $privateEntityManager;
        $this->privateValidator = $privateValidator;
        $this->privateIdentifierBuilder = $privateIdentifierBuilder;
        $this->privatePreUpdatePlugins = $privatePreUpdatePlugins;
        $this->privatePostUpdatePlugins = $privatePostUpdatePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function updatePrivateCollection(
        PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
    ): PrivateCollectionResponseTransfer {
        $privateCollectionResponseTransfer = new PrivateCollectionResponseTransfer();
        $privateCollectionResponseTransfer->setPrivates($privateCollectionRequestTransfer->getPrivates());

        $privateCollectionResponseTransfer = $this->privateValidator->validateCollection($privateCollectionResponseTransfer);

        if ($privateCollectionRequestTransfer->getIsTransactional() && $privateCollectionResponseTransfer->getErrors()->count()) {
            return $privateCollectionResponseTransfer;
        }

        $privateCollectionResponseTransfer = $this->filterInvalidPrivates($privateCollectionResponseTransfer);

        // This will save all entities in one transaction. If any of the entities in the collection fails to be persisted
        // it will roll all of them back. And we don't catch exceptions here intentionally!
        return $this->getTransactionHandler()->handleTransaction(function () use ($privateCollectionResponseTransfer) {
            return $this->executeUpdatePrivateCollectionResponseTransaction($privateCollectionResponseTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    protected function filterInvalidPrivates(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer {
        $privateIdsWithErrors = $this->getPrivateIdsWithErrors($privateCollectionResponseTransfer->getErrors());

        $privateTransfers = $privateCollectionResponseTransfer->getPrivates();
        $privateCollectionResponseTransfer->setPrivates(new ArrayObject());

        foreach ($privateTransfers as $privateTransfer) {
            // Check each SINGLE item before it is saved for errors, if it has some continue with the next one.
            if (!in_array($this->privateIdentifierBuilder->buildIdentifier($privateTransfer), $privateIdsWithErrors, true)) {
                $privateCollectionResponseTransfer->addPrivate($privateTransfer);
            }
        }

        return $privateCollectionResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    protected function executeUpdatePrivateCollectionResponseTransaction(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer {
        // Run pre-save plugins
        $privateTransfers = $this->executePrivatePreUpdatePlugins($privateCollectionResponseTransfer->getPrivates()->getArrayCopy());

        $persistedPrivateTransfers = [];

        foreach ($privateTransfers as $privateTransfer) {
            $persistedPrivateTransfers[] = $this->privateEntityManager->updatePrivate($privateTransfer);
        }

        // Run post-save plugins
        $persistedPrivateTransfers = $this->executePrivatePostUpdatePlugins($persistedPrivateTransfers);

        $privateCollectionResponseTransfer->setPrivates(new ArrayObject($persistedPrivateTransfers));

        return $privateCollectionResponseTransfer;
    }

    /**
     * @param array<\Generated\Shared\Transfer\PrivateTransfer> $privateTransfers
     *
     * @return array<\Generated\Shared\Transfer\PrivateTransfer>
     */
    protected function executePrivatePreUpdatePlugins(
        array $privateTransfers
    ): array {
        foreach ($this->privatePreUpdatePlugins as $privatePreUpdatePlugin) {
            $privateTransfers = $privatePreUpdatePlugin->execute($privateTransfers);
        }

        return $privateTransfers;
    }

    /**
     * @param array<\Generated\Shared\Transfer\PrivateTransfer> $privateTransfers
     *
     * @return array<\Generated\Shared\Transfer\PrivateTransfer>
     */
    protected function executePrivatePostUpdatePlugins(
        array $privateTransfers
    ): array {
        foreach ($this->privatePostUpdatePlugins as $privatePostUpdatePlugin) {
            $privateTransfers = $privatePostUpdatePlugin->execute($privateTransfers);
        }

        return $privateTransfers;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ErrorTransfer> $errorTransfers
     *
     * @return array<string>
     */
    protected function getPrivateIdsWithErrors(ArrayObject $errorTransfers): array
    {
        return array_unique(array_map(static function (ErrorTransfer $errorTransfer): ?string {
            return $errorTransfer->getEntityIdentifier();
        }, $errorTransfers->getArrayCopy()));
    }
}
