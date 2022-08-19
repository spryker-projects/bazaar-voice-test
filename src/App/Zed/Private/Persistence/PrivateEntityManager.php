<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Persistence;

use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateTransfer;
use Orm\Zed\Private\Persistence\SpyPrivate;
use Orm\Zed\Private\Persistence\SpyPrivateQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \App\Zed\Private\Persistence\PrivatePersistenceFactory getFactory()
 */
class PrivateEntityManager extends AbstractEntityManager implements PrivateEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function createPrivate(PrivateTransfer $privateTransfer): PrivateTransfer
    {
        $privateEntity = $this->getFactory()->createPrivateMapper()->mapPrivateTransferToPrivateEntity($privateTransfer, new SpyPrivate());
        $privateEntity->save();

        return $this->getFactory()->createPrivateMapper()->mapPrivateEntityToPrivateTransfer($privateEntity, $privateTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function updatePrivate(PrivateTransfer $privateTransfer): PrivateTransfer
    {
        $privateEntity = $this->getFactory()->createPrivateQuery()->filterByIdPrivate($privateTransfer->getIdPrivateOrFail())->findOne();
        $privateMapper = $this->getFactory()->createPrivateMapper();
        $privateEntity = $privateMapper->mapPrivateTransferToPrivateEntity($privateTransfer, $privateEntity);
        $privateEntity->save();

        return $privateMapper->mapPrivateEntityToPrivateTransfer($privateEntity, $privateTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function deletePrivate(PrivateTransfer $privateTransfer): PrivateTransfer
    {
        $privateEntity = $this->getFactory()->createPrivateQuery()->filterByIdPrivate($privateTransfer->getIdPrivateOrFail())->findOne();
        $privateMapper = $this->getFactory()->createPrivateMapper();
        $privateEntity = $privateMapper->mapPrivateTransferToPrivateEntity($privateTransfer, $privateEntity);
        $privateEntity->delete();

        return $privateMapper->mapPrivateEntityToPrivateTransfer($privateEntity, $privateTransfer);
    }

    /**
     * @param \Orm\Zed\Private\Persistence\SpyPrivateQuery $privateQuery
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Orm\Zed\Private\Persistence\SpyPrivateQuery
     */
    protected function applyPrivateDeleteFilters(
        SpyPrivateQuery $privateQuery,
        PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
    ): SpyPrivateQuery {
        if ($privateCollectionDeleteCriteriaTransfer->getPrivateIds()) {
            $privateQuery->filterByIdPrivate($privateCollectionDeleteCriteriaTransfer->getPrivateIds(), Criteria::IN);
        }
        if ($privateCollectionDeleteCriteriaTransfer->getUuids()) {
            $privateQuery->filterByUuid($privateCollectionDeleteCriteriaTransfer->getUuids(), Criteria::IN);
        }

        return $privateQuery;
    }
}
