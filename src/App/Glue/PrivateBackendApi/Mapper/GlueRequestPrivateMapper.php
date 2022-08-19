<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\PrivateBackendApi\Mapper;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionRequestTransfer;
use Generated\Shared\Transfer\PrivateConditionsTransfer;
use Generated\Shared\Transfer\PrivateCriteriaTransfer;
use Generated\Shared\Transfer\PrivateTransfer;

class GlueRequestPrivateMapper implements GlueRequestPrivateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCriteriaTransfer
     */
    public function mapGlueRequestTransferToPrivateCriteriaTransfer(
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCriteriaTransfer {
        $privateCriteriaTransfer = new PrivateCriteriaTransfer();
        $privateCriteriaTransfer->setPagination($glueRequestTransfer->getPagination());
        $privateCriteriaTransfer->setSortCollection($glueRequestTransfer->getSortings());
        $privateConditionsTransfer = new PrivateConditionsTransfer();
        if (!isset($glueRequestTransfer->getQueryFields()['filter'])) {
            return $privateCriteriaTransfer;
        }
        foreach ($glueRequestTransfer->getQueryFields()['filter'] as $key => $value) {
            // Apply conditions to $privateConditionsTransfer
        }
        $privateCriteriaTransfer->setPrivateConditions($privateConditionsTransfer);

        return $privateCriteriaTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer
     */
    public function mapGlueRequestTransferToPrivateCollectionDeleteCriteriaTransfer(
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCollectionDeleteCriteriaTransfer {
        $privateDeleteCollectionCriteriaTransfer = new PrivateCollectionDeleteCriteriaTransfer();
        if (!isset($glueRequestTransfer->getQueryFields()['filter'])) {
            return $privateDeleteCollectionCriteriaTransfer;
        }
        foreach ($glueRequestTransfer->getQueryFields()['filter'] as $key => $value) {
            // Apply conditions to $privateDeleteCollectionCriteriaTransfer
        }

        return $privateDeleteCollectionCriteriaTransfer;
    }

    /**
     * @param int $identifier
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCriteriaTransfer
     */
    public function mapIdentifierToPrivateCriteriaTransfer(int $identifier, GlueRequestTransfer $glueRequestTransfer): PrivateCriteriaTransfer
    {
        $privateCriteriaTransfer = new PrivateCriteriaTransfer();
        $privateCriteriaTransfer->setPrivateConditions((new PrivateConditionsTransfer())->addPrivateId($identifier));

        return $privateCriteriaTransfer;
    }

    /**
     * @param int $identifier
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer
     */
    public function mapIdentifierToPrivateCollectionDeleteCriteriaTransfer(
        int $identifier,
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCollectionDeleteCriteriaTransfer {
        $privateCollectionDeleteCriteriaTransfer = new PrivateCollectionDeleteCriteriaTransfer();
        $privateCollectionDeleteCriteriaTransfer->setIsTransactional(false)->addIdPrivate($identifier);

        return $privateCollectionDeleteCriteriaTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionRequestTransfer
     */
    public function mapPrivateTransferToPrivateCollectionRequestTransfer(
        PrivateTransfer $privateTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): PrivateCollectionRequestTransfer {
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer)->setIsTransactional(false);

        return $privateCollectionRequestTransfer;
    }
}
