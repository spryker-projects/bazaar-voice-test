<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Validator\Rules;

use Generated\Shared\Transfer\PrivateTransfer;

interface PrivateValidatorRuleInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return array<string>
     */
    public function validate(PrivateTransfer $privateTransfer): array;
}
