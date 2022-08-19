<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Persistence\Propel\Private\Mapper;

use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Generated\Shared\Transfer\PrivateCollectionTransfer;
use Generated\Shared\Transfer\PrivateTransfer;
use Orm\Zed\Private\Persistence\SpyPrivate;
use Propel\Runtime\Collection\ObjectCollection;

class PrivateMapper
{
    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Orm\Zed\Private\Persistence\SpyPrivate $privateEntity
     *
     * @return \Orm\Zed\Private\Persistence\SpyPrivate
     */
    public function mapPrivateTransferToPrivateEntity(PrivateTransfer $privateTransfer, SpyPrivate $privateEntity): SpyPrivate
    {
        return $privateEntity->fromArray($privateTransfer->modifiedToArray());
    }

    /**
     * @param \Orm\Zed\Private\Persistence\SpyPrivate $privateEntity
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function mapPrivateEntityToPrivateTransfer(SpyPrivate $privateEntity, PrivateTransfer $privateTransfer): PrivateTransfer
    {
        return $privateTransfer->fromArray($privateEntity->toArray(), true);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Private\Persistence\SpyPrivate> $privateEntityCollection
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function mapPrivateEntityCollectionToPrivateCollectionResponseTransfer(
        ObjectCollection $privateEntityCollection,
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): PrivateCollectionResponseTransfer {
        foreach ($privateEntityCollection as $privateEntity) {
            $privateCollectionResponseTransfer->addPrivate($this->mapPrivateEntityToPrivateTransfer($privateEntity, new PrivateTransfer()));
        }

        return $privateCollectionResponseTransfer;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Private\Persistence\SpyPrivate> $privateEntityCollection
     * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function mapPrivateEntityCollectionToPrivateCollectionTransfer(
        ObjectCollection $privateEntityCollection,
        PrivateCollectionTransfer $privateCollectionTransfer
    ): PrivateCollectionTransfer {
        foreach ($privateEntityCollection as $privateEntity) {
            $privateCollectionTransfer->addPrivate($this->mapPrivateEntityToPrivateTransfer($privateEntity, new PrivateTransfer()));
        }

        return $privateCollectionTransfer;
    }
}
