<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\PrivateBackendApi\Plugin;

use _Spryk_2760be2a\Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use App\Glue\PrivateBackendApi\Controller\ApplicationResourceController;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\PrivateTransfer;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueRestApiConventionExtension\Dependency\Plugin\RestResourceInterface;

class PrivateBackendApiResource extends AbstractResourcePlugin implements RestResourceInterface
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return 'private/application/config';
    }

    /**
     * @uses \App\Glue\PrivateBackendApi\Controller\ApplicationResourceController
     *
     * @return string
     */
    public function getController(): string
    {
        return ApplicationResourceController::class;
    }

    /**
     * @return \Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer
     */
    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes(PrivateTransfer::class));
    }
}
