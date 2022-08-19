<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Validator;

use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Generated\Shared\Transfer\PrivateTransfer;

interface PrivateValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function validateCollection(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function validate(
        PrivateTransfer $privateTransfer,
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer;
}
