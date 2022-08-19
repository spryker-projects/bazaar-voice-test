<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\PrivateBackendApi;

use App\Glue\PrivateBackendApi\Mapper\GlueRequestPrivateMapper;
use App\Glue\PrivateBackendApi\Mapper\GlueRequestPrivateMapperInterface;
use App\Glue\PrivateBackendApi\Mapper\GlueResponsePrivateMapper;
use App\Glue\PrivateBackendApi\Mapper\GlueResponsePrivateMapperInterface;
use App\Zed\Private\Business\PrivateFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;

class PrivateBackendApiFactory extends AbstractFactory
{
    /**
     * @return \App\Glue\PrivateBackendApi\Mapper\GlueRequestPrivateMapperInterface
     */
    public function createGlueRequestPrivateMapper(): GlueRequestPrivateMapperInterface
    {
        return new GlueRequestPrivateMapper();
    }

    /**
     * @return \App\Glue\PrivateBackendApi\Mapper\GlueResponsePrivateMapperInterface
     */
    public function createGlueResponsePrivateMapper(): GlueResponsePrivateMapperInterface
    {
        return new GlueResponsePrivateMapper();
    }

    /**
     * @return \App\Zed\Private\Business\PrivateFacadeInterface
     */
    public function getPrivateFacade(): PrivateFacadeInterface
    {
        return $this->getProvidedDependency(PrivateBackendApiDependencyProvider::FACADE_PRIVATE);
    }
}
