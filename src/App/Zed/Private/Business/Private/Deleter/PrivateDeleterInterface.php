<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Deleter;

use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;

interface PrivateDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function deletePrivateCollection(
        PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
    ): PrivateCollectionResponseTransfer;
}
