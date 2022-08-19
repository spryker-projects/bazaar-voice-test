<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \App\Zed\Private\PrivateConfig getConfig()
 */
class PrivateDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_PRIVATE_PRE_CREATE = 'PLUGINS_PRIVATE_PRE_CREATE';

    /**
     * @var string
     */
    public const PLUGINS_PRIVATE_POST_CREATE = 'PLUGINS_PRIVATE_POST_CREATE';

    /**
     * @var string
     */
    public const PLUGINS_PRIVATE_PRE_UPDATE = 'PLUGINS_PRIVATE_PRE_UPDATE';

    /**
     * @var string
     */
    public const PLUGINS_PRIVATE_POST_UPDATE = 'PLUGINS_PRIVATE_POST_UPDATE';

    /**
     * @var string
     */
    public const PLUGINS_PRIVATE_EXPANDER = 'PLUGINS_PRIVATE_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_PRIVATE_CREATE_VALIDATOR_RULE = 'PLUGINS_PRIVATE_CREATE_VALIDATOR_RULE';

    /**
     * @var string
     */
    public const PLUGINS_PRIVATE_UPDATE_VALIDATOR_RULE = 'PLUGINS_PRIVATE_UPDATE_VALIDATOR_RULE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addPrivatePreCreatePlugins($container);
        $container = $this->addPrivatePostCreatePlugins($container);
        $container = $this->addPrivatePreUpdatePlugins($container);
        $container = $this->addPrivatePostUpdatePlugins($container);
        $container = $this->addPrivateExpanderPlugins($container);
        $container = $this->addPrivateCreateValidatorRulePlugins($container);
        $container = $this->addPrivateUpdateValidatorRulePlugins($container);

        return $container;
    }

    /**
     * @return array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateCreatePluginInterface>
     */
    protected function getPrivatePreCreatePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPrivatePreCreatePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRIVATE_PRE_CREATE, function (Container $container) {
            return $this->getPrivatePreCreatePlugins();
        });

        return $container;
    }

    /**
     * @return array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateCreatePluginInterface>
     */
    protected function getPrivatePostCreatePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPrivatePostCreatePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRIVATE_POST_CREATE, function (Container $container) {
            return $this->getPrivatePostCreatePlugins();
        });

        return $container;
    }

    /**
     * @return array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface>
     */
    protected function getPrivatePreUpdatePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPrivatePreUpdatePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRIVATE_PRE_UPDATE, function (Container $container) {
            return $this->getPrivatePreUpdatePlugins();
        });

        return $container;
    }

    /**
     * @return array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface>
     */
    protected function getPrivatePostUpdatePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPrivatePostUpdatePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRIVATE_POST_UPDATE, function (Container $container) {
            return $this->getPrivatePostUpdatePlugins();
        });

        return $container;
    }

    /**
     * @return array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Expander\PrivateExpanderPluginInterface>
     */
    protected function getPrivateExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPrivateExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRIVATE_EXPANDER, function (Container $container) {
            return $this->getPrivateExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator\PrivateValidatorRulePluginInterface>
     */
    protected function getPrivateCreateValidatorRulePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPrivateCreateValidatorRulePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRIVATE_CREATE_VALIDATOR_RULE, function (Container $container) {
            return $this->getPrivateCreateValidatorRulePlugins();
        });

        return $container;
    }

    /**
     * @return array<\App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator\PrivateValidatorRulePluginInterface>
     */
    protected function getPrivateUpdateValidatorRulePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPrivateUpdateValidatorRulePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRIVATE_UPDATE_VALIDATOR_RULE, function (Container $container) {
            return $this->getPrivateUpdateValidatorRulePlugins();
        });

        return $container;
    }
}
