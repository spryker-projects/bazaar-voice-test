<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Glue\GlueRestApiConvention;

use Spryker\Glue\GlueRestApiConvention\GlueRestApiConventionDependencyProvider as SprykerGlueRestApiConventionDependencyProvider;
use Spryker\Glue\GlueRestApiConvention\Plugin\GlueRestApiConvention\AcceptFormatRequestValidatorPlugin;
use Spryker\Glue\GlueRestApiConvention\Plugin\GlueRestApiConvention\FormatRequestBuilderPlugin;
use Spryker\Glue\GlueRestApiConvention\Plugin\GlueRestApiConvention\JsonResponseEncoderPlugin;
use Spryker\Glue\GlueRestApiConvention\Plugin\GlueRestApiConvention\PaginationRequestBuilderPlugin;
use Spryker\Glue\GlueRestApiConvention\Plugin\GlueRestApiConvention\RestApiResponseFormatterPlugin;
use Spryker\Glue\GlueRestApiConvention\Plugin\GlueRestApiConvention\SortRequestBuilderPlugin;
use Spryker\Glue\Kernel\Container;

class GlueRestApiConventionDependencyProvider extends SprykerGlueRestApiConventionDependencyProvider
{
    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $container;
    }

    /**
     * @return array<\Spryker\Glue\GlueRestApiConventionExtension\Dependency\Plugin\ResponseEncoderPluginInterface>
     */
    public function getResponseEncoderPlugins(): array
    {
        return [new JsonResponseEncoderPlugin()];
    }

    /**
     * @return array<\Spryker\Glue\GlueRestApiConventionExtension\Dependency\Plugin\RequestBuilderPluginInterface>
     */
    public function getRequestBuilderPlugins(): array
    {
        return [new FormatRequestBuilderPlugin(), new PaginationRequestBuilderPlugin(), new SortRequestBuilderPlugin()];
    }

    /**
     * @return array<\Spryker\Glue\GlueRestApiConventionExtension\Dependency\Plugin\RequestValidatorPluginInterface>
     */
    public function getRequestValidatorPlugins(): array
    {
        return [new AcceptFormatRequestValidatorPlugin()];
    }

    /**
     * @return array<\Spryker\Glue\GlueRestApiConventionExtension\Dependency\Plugin\ResponseFormatterPluginInterface>
     */
    public function getResponseFormatterPlugins(): array
    {
        return [new RestApiResponseFormatterPlugin()];
    }
}
