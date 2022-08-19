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
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \App\Zed\Private\Business\PrivateBusinessFactory getFactory()
 * @method \App\Zed\Private\Persistence\PrivateRepositoryInterface getRepository()
 * @method \App\Zed\Private\Persistence\PrivateEntityManagerInterface getEntityManager()
 */
class PrivateFacade extends AbstractFacade implements PrivateFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCriteriaTransfer $privateCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionTransfer
     */
    public function getPrivateCollection(
        PrivateCriteriaTransfer $privateCriteriaTransfer
    ): PrivateCollectionTransfer {
        return $this->getFactory()->createPrivateReader()->getPrivateCollection($privateCriteriaTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function createPrivateCollection(
        PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
    ): PrivateCollectionResponseTransfer {
        return $this->getFactory()->createPrivateCreator()->createPrivateCollection($privateCollectionRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function updatePrivateCollection(PrivateCollectionRequestTransfer $privateCollectionRequestTransfer): PrivateCollectionResponseTransfer
    {
        return $this->getFactory()->createPrivateUpdater()->updatePrivateCollection($privateCollectionRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function deletePrivateCollection(
        PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
    ): PrivateCollectionResponseTransfer {
        return $this->getFactory()->createPrivateDeleter()->deletePrivateCollection($privateCollectionDeleteCriteriaTransfer);
    }
}
