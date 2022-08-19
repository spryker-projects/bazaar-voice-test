<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business;

use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionRequestTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Generated\Shared\Transfer\PrivateCollectionTransfer;
use Generated\Shared\Transfer\PrivateCriteriaTransfer;

interface PrivateFacadeInterface
{
    /**
     * Specification:
     * - Fetches collection of Privates from the storage.
     * - Uses `PrivateCriteriaTransfer.PrivateConditions.privateIds` to filter privates by privateIds.
     * - Uses `PrivateCriteriaTransfer.PrivateConditions.uuids` to filter privates by uuids.
     * - Uses `PrivateCriteriaTransfer.SortTransfer.field` to set the `order by` field.
     * - Uses `PrivateCriteriaTransfer.SortTransfer.isAscending` to set ascending order otherwise will be used descending order.
     * - Uses `PrivateCriteriaTransfer.PaginationTransfer.{limit, offset}` to paginate result with limit and offset.
     * - Uses `PrivateCriteriaTransfer.PaginationTransfer.{page, maxPerPage}` to paginate result with page and maxPerPage.
     * - Executes `PrivateExpanderPluginInterface` before return the collection transfer.
     * - Returns `PrivateCollectionTransfer` filled with found privates.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCriteriaTransfer $privateCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function getPrivateCollection(PrivateCriteriaTransfer $privateCriteriaTransfer): PrivateCollectionTransfer;

    /**
     * Specification:
     * - Stores collection of Privates to the storage.
     * - Uses `PrivateValidatorInterface` to validate `PrivateTransfer` before save.
     * - Uses `PrivateValidatorRulePluginInterface` to validate `PrivateTransfer` before save.
     * - Executes pre-create `PrivateCreatePluginInterface` before create the `PrivateTransfer`.
     * - Executes post-create `PrivateCreatePluginInterface` after create the `PrivateTransfer`.
     * - Returns `PrivateCollectionResponseTransfer.PrivateTransfer[]` filled with created privates.
     * - Returns `PrivateCollectionResponseTransfer.ErrorTransfer[]` filled with validation errors.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function createPrivateCollection(
        PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
    ): PrivateCollectionResponseTransfer;

    /**
     * Specification:
     * - Updates collection of Privates in the storage.
     * - Uses `PrivateValidatorInterface` to validate `PrivateTransfer` before save.
     * - Uses `PrivateValidatorRulePluginInterface` to validate `PrivateTransfer` before save.
     * - Executes pre-update `PrivateUpdatePluginInterface` before update the `PrivateTransfer`.
     * - Executes post-update `PrivateUpdatePluginInterface` after update the `PrivateTransfer`.
     * - Returns `PrivateCollectionResponseTransfer.PrivateTransfer[]` filled with updated privates.
     * - Returns `PrivateCollectionResponseTransfer.ErrorTransfer[]` filled with validation errors.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function updatePrivateCollection(PrivateCollectionRequestTransfer $privateCollectionRequestTransfer): PrivateCollectionResponseTransfer;

    /**
     * Specification:
     * - Deletes collection of Privates from the storage by delete criteria.
     * - Uses `PrivateCollectionDeleteCriteriaTransfer.privateIds` to filter privates by privateIds.
     * - Uses `PrivateCollectionDeleteCriteriaTransfer.uuids` to filter privates by uuids.
     * - Uses `PrivateCollectionDeleteCriteriaTransfer.isTransactional` to make transactional delete.
     * - Returns `PrivateCollectionResponseTransfer.PrivateTransfer[]` filled with deleted privates.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function deletePrivateCollection(
        PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
    ): PrivateCollectionResponseTransfer;
}
