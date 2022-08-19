<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\PrivateBackendApi\Mapper;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionRequestTransfer;
use Generated\Shared\Transfer\PrivateCriteriaTransfer;
use Generated\Shared\Transfer\PrivateTransfer;

interface GlueRequestPrivateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCriteriaTransfer
     */
    public function mapGlueRequestTransferToPrivateCriteriaTransfer(
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCriteriaTransfer;

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer
     */
    public function mapGlueRequestTransferToPrivateCollectionDeleteCriteriaTransfer(
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCollectionDeleteCriteriaTransfer;

    /**
     * @param int $identifier
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCriteriaTransfer
     */
    public function mapIdentifierToPrivateCriteriaTransfer(int $identifier, GlueRequestTransfer $glueRequestTransfer): PrivateCriteriaTransfer;

    /**
     * @param int $identifier
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer
     */
    public function mapIdentifierToPrivateCollectionDeleteCriteriaTransfer(
        int $identifier,
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCollectionDeleteCriteriaTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionRequestTransfer
     */
    public function mapPrivateTransferToPrivateCollectionRequestTransfer(
        PrivateTransfer $privateTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCollectionRequestTransfer;
}
