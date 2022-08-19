<?php
/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace App\Zed\Private\Business;


/**
 * @method \App\Zed\Private\PrivateConfig getConfig()
  * @method \App\Zed\Private\Persistence\PrivateEntityManagerInterface getEntityManager()
  * @method \App\Zed\Private\Persistence\PrivateRepositoryInterface getRepository()
 */
class PrivateBusinessFactory extends \Spryker\Zed\Kernel\Business\AbstractBusinessFactory
{
    /**
     * @return \App\Zed\Private\Business\Private\Deleter\PrivateDeleterInterface    */
    public function createPrivateDeleter() : \App\Zed\Private\Business\Private\Deleter\PrivateDeleterInterface
    {
        return new \App\Zed\Private\Business\Private\Deleter\PrivateDeleter($this->getEntityManager(), $this->getRepository());
    }
    /**
     * @return \App\Zed\Private\Business\Private\Writer\PrivateCreatorInterface    */
    public function createPrivateCreator() : \App\Zed\Private\Business\Private\Writer\PrivateCreatorInterface
    {
        return new \App\Zed\Private\Business\Private\Writer\PrivateCreator($this->getEntityManager(), $this->createPrivateCreateValidator(), $this->createPrivateIdentifierBuilder(), $this->getPrivatePreCreatePlugins(), $this->getPrivatePostCreatePlugins());
    }
    /**
     * @return \App\Zed\Private\Business\Private\Reader\PrivateReaderInterface    */
    public function createPrivateReader() : \App\Zed\Private\Business\Private\Reader\PrivateReaderInterface
    {
        return new \App\Zed\Private\Business\Private\Reader\PrivateReader($this->getRepository(), $this->getPrivateExpanderPlugins());
    }
    /**
     * @return \App\Zed\Private\Business\Private\Writer\PrivateUpdaterInterface    */
    public function createPrivateUpdater() : \App\Zed\Private\Business\Private\Writer\PrivateUpdaterInterface
    {
        return new \App\Zed\Private\Business\Private\Writer\PrivateUpdater($this->getEntityManager(), $this->createPrivateUpdateValidator(), $this->createPrivateIdentifierBuilder(), $this->getPrivatePreUpdatePlugins(), $this->getPrivatePostUpdatePlugins());
    }
    /**
     * @return \App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface    */
    public function createPrivateIdentifierBuilder() : \App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilderInterface
    {
        return new \App\Zed\Private\Business\Private\IdentifierBuilder\PrivateIdentifierBuilder();
    }
    /**
     * @return \App\Zed\Private\Business\Private\Validator\PrivateValidatorInterface    */
    public function createPrivateCreateValidator() : \App\Zed\Private\Business\Private\Validator\PrivateValidatorInterface
    {
        return new \App\Zed\Private\Business\Private\Validator\PrivateValidator($this->getPrivateCreateValidatorRules(), $this->getPrivateCreateValidatorRulePlugins(), $this->createPrivateIdentifierBuilder());
    }
    /**
     * @return \App\Zed\Private\Business\Private\Validator\Rules\PrivateValidatorRuleInterface[]    */
    public function getPrivateCreateValidatorRules() : array
    {
        return [];
    }
    /**
     * @return \App\Zed\Private\Business\Private\Validator\PrivateValidatorInterface    */
    public function createPrivateUpdateValidator() : \App\Zed\Private\Business\Private\Validator\PrivateValidatorInterface
    {
        return new \App\Zed\Private\Business\Private\Validator\PrivateValidator($this->getPrivateUpdateValidatorRules(), $this->getPrivateUpdateValidatorRulePlugins(), $this->createPrivateIdentifierBuilder());
    }
    /**
     * @return \App\Zed\Private\Business\Private\Validator\Rules\PrivateValidatorRuleInterface[]    */
    public function getPrivateUpdateValidatorRules() : array
    {
        return [];
    }
    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Expander\PrivateExpanderPluginInterface[]
     */
    public function getPrivateExpanderPlugins() : array
    {
        return $this->getProvidedDependency(\App\Zed\Private\PrivateDependencyProvider::PLUGINS_PRIVATE_EXPANDER);
    }
    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateCreatePluginInterface[]
     */
    public function getPrivatePreCreatePlugins() : array
    {
        return $this->getProvidedDependency(\App\Zed\Private\PrivateDependencyProvider::PLUGINS_PRIVATE_PRE_CREATE);
    }
    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateCreatePluginInterface[]
     */
    public function getPrivatePostCreatePlugins() : array
    {
        return $this->getProvidedDependency(\App\Zed\Private\PrivateDependencyProvider::PLUGINS_PRIVATE_POST_CREATE);
    }
    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface[]
     */
    public function getPrivatePreUpdatePlugins() : array
    {
        return $this->getProvidedDependency(\App\Zed\Private\PrivateDependencyProvider::PLUGINS_PRIVATE_PRE_UPDATE);
    }
    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface[]
     */
    public function getPrivatePostUpdatePlugins() : array
    {
        return $this->getProvidedDependency(\App\Zed\Private\PrivateDependencyProvider::PLUGINS_PRIVATE_POST_UPDATE);
    }
    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator\PrivateValidatorRulePluginInterface[]
     */
    public function getPrivateCreateValidatorRulePlugins() : array
    {
        return $this->getProvidedDependency(\App\Zed\Private\PrivateDependencyProvider::PLUGINS_PRIVATE_CREATE_VALIDATOR_RULE);
    }
    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator\PrivateValidatorRulePluginInterface[]
     */
    public function getPrivateUpdateValidatorRulePlugins() : array
    {
        return $this->getProvidedDependency(\App\Zed\Private\PrivateDependencyProvider::PLUGINS_PRIVATE_UPDATE_VALIDATOR_RULE);
    }
}
