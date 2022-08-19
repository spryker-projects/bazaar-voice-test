<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\PrivateBackendApi\Mapper;

use Generated\Shared\Transfer\GlueResponseTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Generated\Shared\Transfer\PrivateCollectionTransfer;

interface GlueResponsePrivateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionTransferToGlueResponseTransfer(
        PrivateCollectionTransfer $privateCollectionTransfer
    ): GlueResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionTransferToSingleResourceGlueResponseTransfer(
        PrivateCollectionTransfer $privateCollectionTransfer
    ): GlueResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionResponseTransferToGlueResponseTransfer(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): GlueResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionResponseTransferToSingleResourceGlueResponseTransfer(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): GlueResponseTransfer;
}
