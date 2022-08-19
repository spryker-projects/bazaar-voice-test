<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Persistence;

use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionTransfer;
use Generated\Shared\Transfer\PrivateCriteriaTransfer;
use Orm\Zed\Private\Persistence\SpyPrivateQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \App\Zed\Private\Persistence\PrivatePersistenceFactory getFactory()
 */
class PrivateRepository extends AbstractRepository implements PrivateRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateCriteriaTransfer $privateCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function getPrivateCollection(
        PrivateCriteriaTransfer $privateCriteriaTransfer
    ): PrivateCollectionTransfer {
        $privateCollectionTransfer = new PrivateCollectionTransfer();
        $privateQuery = $this->getFactory()->createPrivateQuery();
        // Filter
        $privateQuery = $this->applyPrivateFilters($privateQuery, $privateCriteriaTransfer);
        // Sort
        $privateQuery = $this->applyPrivateSorting($privateQuery, $privateCriteriaTransfer);
        // Paginate only if the transfer is present
        $paginationTransfer = $privateCriteriaTransfer->getPagination();
        if ($paginationTransfer !== null) {
            $privateQuery = $this->applyPrivatePagination($privateQuery, $paginationTransfer);
            $privateCollectionTransfer->setPagination($paginationTransfer);
        }
        $objectCollection = $privateQuery->find();

        return $this->getFactory()->createPrivateMapper()->mapPrivateEntityCollectionToPrivateCollectionTransfer($objectCollection, $privateCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function getPrivateDeleteCollection(
        PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
    ): PrivateCollectionTransfer {
        $privateCollectionTransfer = new PrivateCollectionTransfer();
        $privateQuery = $this->getFactory()->createPrivateQuery();
        $privateEntities = $this->applyPrivateDeleteFilters($privateQuery, $privateCollectionDeleteCriteriaTransfer)->find();
        if (!$privateEntities->count()) {
            return $privateCollectionTransfer;
        }

        return $this->getFactory()->createPrivateMapper()->mapPrivateEntityCollectionToPrivateCollectionTransfer($privateEntities, $privateCollectionTransfer);
    }

    /**
     * @param \Orm\Zed\Private\Persistence\SpyPrivateQuery $privateQuery
     * @param \Generated\Shared\Transfer\PrivateCriteriaTransfer $privateCriteriaTransfer
     *
     * @return \Orm\Zed\Private\Persistence\SpyPrivateQuery
     */
    protected function applyPrivateFilters(
        SpyPrivateQuery $privateQuery,
        PrivateCriteriaTransfer $privateCriteriaTransfer
    ): SpyPrivateQuery {
        $privateConditionsTransfer = $privateCriteriaTransfer->getPrivateConditions();
        if ($privateConditionsTransfer === null) {
            return $privateQuery;
        }

        return $this->buildQueryByConditions($privateConditionsTransfer->modifiedToArray(), $privateQuery);
    }

    /**
     * @param \Orm\Zed\Private\Persistence\SpyPrivateQuery $privateQuery
     * @param \Generated\Shared\Transfer\PaginationTransfer $paginationTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function applyPrivatePagination(
        SpyPrivateQuery $privateQuery,
        PaginationTransfer $paginationTransfer
    ): ModelCriteria {
        if ($paginationTransfer->getOffset() !== null || $paginationTransfer->getLimit() !== null) {
            $privateQuery->offset($paginationTransfer->getOffsetOrFail())->setLimit($paginationTransfer->getLimitOrFail());

            return $privateQuery;
        }
        $paginationModel = $privateQuery->paginate($paginationTransfer->getPageOrFail(), $paginationTransfer->getMaxPerPageOrFail());
        $paginationTransfer->setNbResults($paginationModel->getNbResults())->setFirstIndex($paginationModel->getFirstIndex())->setLastIndex($paginationModel->getLastIndex())->setFirstPage($paginationModel->getFirstPage())->setLastPage($paginationModel->getLastPage())->setNextPage($paginationModel->getNextPage())->setPreviousPage($paginationModel->getPreviousPage());

        // Map the propel pagination model data to the transfer as needed
        return $paginationModel->getQuery();
    }

    /**
     * @param \Orm\Zed\Private\Persistence\SpyPrivateQuery $privateQuery
     * @param \Generated\Shared\Transfer\PrivateCriteriaTransfer $privateCriteriaTransfer
     *
     * @return \Orm\Zed\Private\Persistence\SpyPrivateQuery
     */
    protected function applyPrivateSorting(SpyPrivateQuery $privateQuery, PrivateCriteriaTransfer $privateCriteriaTransfer): SpyPrivateQuery
    {
        $sortCollection = $privateCriteriaTransfer->getSortCollection();
        foreach ($sortCollection as $sortTransfer) {
            $privateQuery->orderBy($sortTransfer->getField(), $sortTransfer->getIsAscending() ? Criteria::ASC : Criteria::DESC);
        }

        return $privateQuery;
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
        return $this->buildQueryByConditions($privateCollectionDeleteCriteriaTransfer->modifiedToArray(), $privateQuery);
    }

    /**
     * @param array $conditions
     * @param \Orm\Zed\Private\Persistence\SpyPrivateQuery $privateQuery
     *
     * @return \Orm\Zed\Private\Persistence\SpyPrivateQuery
     */
    protected function buildQueryByConditions(array $conditions, SpyPrivateQuery $privateQuery): SpyPrivateQuery
    {
        if (isset($conditions['private_ids'])) {
            $privateQuery->filterByIdPrivate($conditions['private_ids'], Criteria::IN);
        }
        if (isset($conditions['uuids'])) {
            $privateQuery->filterByUuid($conditions['uuids'], Criteria::IN);
        }

        return $privateQuery;
    }
}
