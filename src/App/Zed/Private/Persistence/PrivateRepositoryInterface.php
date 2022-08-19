<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Persistence;

use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionTransfer;
use Generated\Shared\Transfer\PrivateCriteriaTransfer;

interface PrivateRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateCriteriaTransfer $privateCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function getPrivateCollection(PrivateCriteriaTransfer $privateCriteriaTransfer): PrivateCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function getPrivateDeleteCollection(
        PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
    ): PrivateCollectionTransfer;
}
