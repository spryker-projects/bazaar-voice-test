<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\PrivateBackendApi\Mapper;

use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Generated\Shared\Transfer\PrivateCollectionTransfer;
use Generated\Shared\Transfer\PrivateTransfer;
use Symfony\Component\HttpFoundation\Response;

class GlueResponsePrivateMapper implements GlueResponsePrivateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionTransferToGlueResponseTransfer(
        PrivateCollectionTransfer $privateCollectionTransfer
    ): GlueResponseTransfer {
        $glueResponseTransfer = new GlueResponseTransfer();
        foreach ($privateCollectionTransfer->getPrivates() as $privateTransfer) {
            $glueResponseTransfer = $this->addPrivateTransferToGlueResponse($privateTransfer, $glueResponseTransfer);
        }

        return $glueResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionTransferToSingleResourceGlueResponseTransfer(PrivateCollectionTransfer $privateCollectionTransfer): GlueResponseTransfer
    {
        $glueResponseTransfer = new GlueResponseTransfer();
        if ($privateCollectionTransfer->getPrivates()->count() > 0) {
            return $this->addPrivateTransferToGlueResponse($privateCollectionTransfer->getPrivates()->offsetGet(0), $glueResponseTransfer);
        }

        return $this->addNotFoundError($glueResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionResponseTransferToGlueResponseTransfer(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): GlueResponseTransfer {
        $glueResponseTransfer = new GlueResponseTransfer();
        if ($privateCollectionResponseTransfer->getErrors()->count() !== 0) {
            foreach ($privateCollectionResponseTransfer->getErrors() as $error) {
                $glueResponseTransfer->addError((new GlueErrorTransfer())->setMessage($error->getMessage()));
            }

            return $glueResponseTransfer;
        }
        if ($privateCollectionResponseTransfer->getPrivates()->count() === 0) {
            return $this->addNotFoundError($glueResponseTransfer);
        }
        foreach ($privateCollectionResponseTransfer->getPrivates() as $privateTransfer) {
            $glueResponseTransfer = $this->addPrivateTransferToGlueResponse($privateTransfer, $glueResponseTransfer);
        }

        return $glueResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function mapPrivateCollectionResponseTransferToSingleResourceGlueResponseTransfer(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    ): GlueResponseTransfer {
        $glueResponseTransfer = new GlueResponseTransfer();
        if ($privateCollectionResponseTransfer->getPrivates()->count() > 0) {
            return $this->addPrivateTransferToGlueResponse($privateCollectionResponseTransfer->getPrivates()->offsetGet(0), $glueResponseTransfer);
        }

        return $this->addNotFoundError($glueResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\GlueResponseTransfer $glueResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function addNotFoundError(GlueResponseTransfer $glueResponseTransfer): GlueResponseTransfer
    {
        $glueResponseTransfer->setHttpStatus(Response::HTTP_NOT_FOUND)->addError((new GlueErrorTransfer())->setMessage(Response::$statusTexts[Response::HTTP_NOT_FOUND]));

        return $glueResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\GlueResponseTransfer $glueResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function addPrivateTransferToGlueResponse(
        PrivateTransfer $privateTransfer,
        GlueResponseTransfer $glueResponseTransfer
    ): GlueResponseTransfer {
        $resourceTransfer = new GlueResourceTransfer();
        $resourceTransfer->setAttributes($privateTransfer);
        $resourceTransfer->setId($privateTransfer->getIdPrivate());
        $resourceTransfer->setType('private');
        $glueResponseTransfer->addResource($resourceTransfer);

        return $glueResponseTransfer;
    }
}
