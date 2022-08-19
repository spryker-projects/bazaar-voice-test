<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator;

use Generated\Shared\Transfer\PrivateTransfer;

interface PrivateValidatorRulePluginInterface
{
    /**
     * Specification:
     * - Validates the `PrivateTransfer`.
     * - Returns an array with errors for the `PrivateTransfer`.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return array<string>
     */
    public function validate(PrivateTransfer $privateTransfer): array;
}
