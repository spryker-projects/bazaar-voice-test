<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Validator;

use App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Generated\Shared\Transfer\PrivateTransfer;

class PrivateValidator implements PrivateValidatorInterface
{
    /**
     * @var array<\App\Zed\Private\Business\Private\Validator\Rules\PrivateValidatorRuleInterface>
     */
    protected array $validatorRules = [];

    /**
     * @var array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator\PrivateValidatorRulePluginInterface>
     */
    protected array $validatorRulePlugins = [];

    /**
     * @var \App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface
     */
    protected PrivateIdentifierBuilderInterface $identifierBuilder;

    /**
     * @param array<\App\Zed\Private\Business\Private\Validator\Rules\PrivateValidatorRuleInterface> $validatorRules
     * @param array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator\PrivateValidatorRulePluginInterface> $validatorRulePlugins
     * @param \App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface $identifierBuilder
     */
    public function __construct(
        array $validatorRules,
        array $validatorRulePlugins,
        PrivateIdentifierBuilderInterface $identifierBuilder
    ) {
        $this->validatorRules = $validatorRules;
        $this->validatorRulePlugins = $validatorRulePlugins;
        $this->identifierBuilder = $identifierBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function validateCollection(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer {
        foreach ($privateCollectionResponseTransfer->getPrivates() as $privateTransfer) {
            $privateCollectionResponseTransfer = $this->validate($privateTransfer, $privateCollectionResponseTransfer);
        }

        return $privateCollectionResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function validate(
        PrivateTransfer $privateTransfer,
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer {
        $privateCollectionResponseTransfer = $this->executeValidatorRules($privateTransfer, $privateCollectionResponseTransfer);
        $privateCollectionResponseTransfer = $this->executeValidatorRulePlugins($privateTransfer, $privateCollectionResponseTransfer);

        return $privateCollectionResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    protected function executeValidatorRules(
        PrivateTransfer $privateTransfer,
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer {
        foreach ($this->validatorRules as $validatorRule) {
            $errors = $validatorRule->validate($privateTransfer);

            $privateCollectionResponseTransfer = $this->addErrorsToCollectionResponseTransfer($privateTransfer, $privateCollectionResponseTransfer, $errors);
        }

        return $privateCollectionResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    protected function executeValidatorRulePlugins(
        PrivateTransfer $privateTransfer,
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer {
        foreach ($this->validatorRulePlugins as $validatorRule) {
            $errors = $validatorRule->validate($privateTransfer);

            $privateCollectionResponseTransfer = $this->addErrorsToCollectionResponseTransfer($privateTransfer, $privateCollectionResponseTransfer, $errors);
        }

        return $privateCollectionResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     * @param array<string> $errors
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    protected function addErrorsToCollectionResponseTransfer(
        PrivateTransfer $privateTransfer,
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer,
        array $errors
    ): PrivateCollectionResponseTransfer {
        $identifier = $this->identifierBuilder->buildIdentifier($privateTransfer);

        foreach ($errors as $error) {
            $privateCollectionResponseTransfer->addError(
                (new ErrorTransfer())
                    ->setMessage($error)
                    ->setEntityIdentifier($identifier),
            );
        }

        return $privateCollectionResponseTransfer;
    }
}
