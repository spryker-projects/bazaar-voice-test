<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\IdentifierBuilder;

use Generated\Shared\Transfer\PrivateTransfer;

class PrivateIdentifierBuilder implements PrivateIdentifierBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return string
     */
    public function buildIdentifier(PrivateTransfer $privateTransfer): string
    {
        return $privateTransfer->getIdPrivate() !== null ? (string)$privateTransfer->getIdPrivate() : spl_object_hash($privateTransfer);
    }
}
