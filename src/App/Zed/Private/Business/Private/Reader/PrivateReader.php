<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Reader;

use App\Zed\Private\Persistence\PrivateRepositoryInterface;
use ArrayObject;
use Generated\Shared\Transfer\PrivateCollectionTransfer;
use Generated\Shared\Transfer\PrivateCriteriaTransfer;

class PrivateReader implements PrivateReaderInterface
{
    /**
     * @var \App\Zed\Private\Persistence\PrivateRepositoryInterface
     */
    protected PrivateRepositoryInterface $privateRepository;

    /**
     * @var array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Expander\PrivateExpanderPluginInterface>
     */
    protected array $privateExpanderPlugins;

    /**
     * @param \App\Zed\Private\Persistence\PrivateRepositoryInterface $privateRepository
     * @param array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Expander\PrivateExpanderPluginInterface> $privateExpanderPlugins
     */
    public function __construct(
        PrivateRepositoryInterface $privateRepository,
        array $privateExpanderPlugins
    ) {
        $this->privateRepository = $privateRepository;
        $this->privateExpanderPlugins = $privateExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCriteriaTransfer $privateCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function getPrivateCollection(
        PrivateCriteriaTransfer $privateCriteriaTransfer
    ): PrivateCollectionTransfer {
        $privateCollectionTransfer = $this->privateRepository
            ->getPrivateCollection($privateCriteriaTransfer);

        return $this->executePrivateExpanderPlugins($privateCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    protected function executePrivateExpanderPlugins(
        PrivateCollectionTransfer $privateCollectionTransfer
    ): PrivateCollectionTransfer {
        $privateTransfers = $privateCollectionTransfer->getPrivates()->getArrayCopy();

        foreach ($this->privateExpanderPlugins as $privateExpanderPlugin) {
            $privateTransfers = $privateExpanderPlugin->expand($privateTransfers);
        }

        return $privateCollectionTransfer->setPrivates(new ArrayObject($privateTransfers));
    }
}
