<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\PrivateBackendApi\Controller;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Generated\Shared\Transfer\PrivateTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method \App\Glue\PrivateBackendApi\PrivateBackendApiFactory getFactory()
 */
class ApplicationResourceController extends AbstractController
{
    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function postAction(
        PrivateTransfer $privateTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $privateCollectionRequestTransfer = $this->getFactory()->createGlueRequestPrivateMapper()->mapPrivateTransferToPrivateCollectionRequestTransfer($privateTransfer, $glueRequestTransfer);
        $privateCollectionResponseTransfer = $this->getFactory()->getPrivateFacade()->createPrivateCollection($privateCollectionRequestTransfer);

        return $this->getFactory()->createGlueResponsePrivateMapper()->mapPrivateCollectionResponseTransferToGlueResponseTransfer($privateCollectionResponseTransfer);
    }
}
