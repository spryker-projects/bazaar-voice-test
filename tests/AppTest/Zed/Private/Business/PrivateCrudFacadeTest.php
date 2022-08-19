<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppTest\Zed\Private\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PrivateCollectionRequestTransfer;

/**
 * Auto-generated group annotations
 *
 * @group AppTest
 * @group Zed
 * @group Private
 * @group Business
 * @group Facade
 * @group PrivateCrudFacadeTest
 * Add your own group annotations below this line
 */
class PrivateCrudFacadeTest extends Unit
{
    /**
     * @var \AppTest\Zed\Private\PrivateBusinessTester
     */
    protected $tester;

    /**
     * Test ensures to always get a Collection back even if no entity was found.
     *
     * @return void
     */
    public function testGetPrivateReturnsEmptyCollectionWhenNoEntityMatchedByCriteria(): void
    {
        // Arrange
        $this->tester->havePrivateTransferWithUuidTwoPersisted();
        $privateCriteriaTransfer = $this->tester->havePrivateCriteriaTransferWithUuidOneCriteria();

        // Act
        $privateCollectionTransfer = $this->tester->getFacade()->getPrivateCollection($privateCriteriaTransfer);

        // Assert
        $this->tester->assertPrivateCollectionIsEmpty($privateCollectionTransfer);
    }

    /**
     * Test ensures to get a Collection with entities back when criteria was matching.
     *
     * @return void
     */
    public function testGetPrivateReturnsCollectionWithOnePrivateEntityWhenCriteriaMatched(): void
    {
        // Arrange
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();
        $privateCriteriaTransfer = $this->tester->havePrivateCriteriaTransferWithUuidOneCriteria();

        // Act
        $privateCollectionTransfer = $this->tester->getFacade()->getPrivateCollection($privateCriteriaTransfer);

        // Assert
        $this->tester->assertPrivateCollectionContainsTransferWithId($privateCollectionTransfer, $privateTransfer);
    }

    /**
     * Test ensures that expanders are applied to found entities.
     *
     * @return void
     */
    public function testGetPrivateCollectionReturnsCollectionWithOneExpandedPrivateEntity(): void
    {
        // Arrange
        $this->tester->havePrivateExpanderPluginSetUuidTwoEnabled();
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();

        $privateCriteriaTransfer = $this->tester->havePrivateCriteriaTransferWithUuidOneCriteria();

        // Act
        $privateCollectionTransfer = $this->tester->getFacade()->getPrivateCollection($privateCriteriaTransfer);

        // Assert
        $this->tester->assertPrivateCollectionContainsTransferWithId($privateCollectionTransfer, $privateTransfer);
    }

    /**
     * @return void
     */
    public function testCreatePrivateCollectionReturnsCollectionWithOnePrivateEntityWhenEntityWasSaved(): void
    {
        // Arrange
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOne();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->createPrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertprivateCollectionResponseContainsOneWithUuidOneTransfer($privateCollectionResponseTransfer);
    }

    /**
     * Tests that pre-create plugins are applied to entities.
     *
     * @return void
     */
    public function testCreatePrivateCollectionAppliesPreCreatePlugins(): void
    {
        // Arrange
        $this->tester->havePrivatePreCreatePluginSetUuidTwoEnabled();
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOne();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->createPrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertprivateCollectionResponseContainsOneWithUuidTwoTransfer($privateCollectionResponseTransfer, $privateTransfer);
    }

    /**
     * Tests that post-create plugins are applied to entities.
     *
     * @return void
     */
    public function testCreatePrivateCollectionAppliesPostCreatePlugins(): void
    {
        // Arrange
        $this->tester->havePrivatePostCreatePluginSetUuidTwoEnabled();
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOne();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->createPrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertprivateCollectionResponseContainsOneWithUuidTwoTransfer($privateCollectionResponseTransfer, $privateTransfer);
    }

    /**
     * Tests that entities are validated with internal ValidatorRuleInterface.
     *
     * @return void
     */
    public function testCreatePrivateCollectionReturnsErroredCollectionResponseWhenValidationRuleFailed(): void
    {
        // Arrange
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();

        $this->tester->havePrivateAlwaysFailingCreateValidatorRuleEnabled(); // This will always return a validation error
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->createPrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsFailedValidationRuleError($privateCollectionResponseTransfer);
    }

    /**
     * Tests that entities are validated with external ValidatorRulePluginInterface.
     *
     * @return void
     */
    public function testCreatePrivateCollectionReturnsErroredCollectionResponseWhenValidationRulePluginFailed(): void
    {
        // Arrange
        $this->tester->havePrivateAlwaysFailingCreateValidatorRulePluginEnabled(); // This will always return a validation error
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOne();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->createPrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsFailedValidationRuleError($privateCollectionResponseTransfer);
    }

    /**
     * @return void
     */
    public function testUpdatePrivateCollectionReturnsCollectionWithOnePrivateEntityWhenEntityWasSaved(): void
    {
        // Arrange
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->updatePrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsOneWithUuidOneTransferWithId($privateCollectionResponseTransfer, $privateTransfer);
    }

    /**
     * Tests that pre-update plugins are applied to entities.
     *
     * @return void
     */
    public function testUpdatePrivateCollectionAppliesPreUpdatePlugins(): void
    {
        // Arrange
        $this->tester->havePrivatePreUpdatePluginSetUuidTwoEnabled();
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->updatePrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsOneWithUuidTwoTransferWithId($privateCollectionResponseTransfer, $privateTransfer);
    }

    /**
     * Tests that post-update plugins are applied to entities.
     *
     * @return void
     */
    public function testUpdatePrivateCollectionAppliesPostUpdatePlugins(): void
    {
        // Arrange
        $this->tester->havePrivatePostUpdatePluginSetUuidTwoEnabled();
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->updatePrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsOneWithUuidTwoTransferWithId($privateCollectionResponseTransfer, $privateTransfer);
    }

    /**
     * Tests that entities are validated with internal ValidatorRuleInterface.
     *
     * @return void
     */
    public function testUpdatePrivateCollectionReturnsErroredCollectionResponseWhenValidationRuleFailed(): void
    {
        // Arrange
        $this->tester->havePrivateAlwaysFailingUpdateValidatorRuleEnabled(); // This will always return a validation error
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->updatePrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsFailedValidationRuleError($privateCollectionResponseTransfer);
    }

    /**
     * Tests that entities are validated with external ValidatorRulePluginInterface.
     *
     * @return void
     */
    public function testUpdatePrivateCollectionReturnsErroredCollectionResponseWhenValidationRulePluginFailed(): void
    {
        // Arrange
        $this->tester->havePrivateAlwaysFailingUpdateValidatorRulePluginEnabled(); // This will always return a validation error
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->updatePrivateCollection($privateCollectionRequestTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsFailedValidationRuleError($privateCollectionResponseTransfer);
    }

    /**
     * Test ensures to always get a Collection back even if no entity was deleted.
     *
     * @return void
     */
    public function testDeletePrivateReturnsEmptyCollectionWhenNoEntityMatchedByCriteria(): void
    {
        // Arrange
        $this->tester->havePrivateTransferWithUuidTwoPersisted();
        $privateDeleteCriteriaTransfer = $this->tester->havePrivateDeleteCriteriaTransferWithUuidOneCriteria();

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->deletePrivateCollection($privateDeleteCriteriaTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseIsEmpty($privateCollectionResponseTransfer);
    }

    /**
     * Test ensures to get a Collection with deleted entities back when criteria was matching.
     *
     * @return void
     */
    public function testDeletePrivateReturnsCollectionWithOnePrivateEntityWhenCriteriaMatched(): void
    {
        // Arrange
        $privateTransfer = $this->tester->havePrivateTransferWithUuidOnePersisted();
        $privateDeleteCriteriaTransfer = $this->tester->havePrivateDeleteCriteriaTransferWithUuidOneCriteria();

        // Act
        $privateCollectionResponseTransfer = $this->tester->getFacade()->deletePrivateCollection($privateDeleteCriteriaTransfer);

        // Assert
        $this->tester->assertPrivateCollectionResponseContainsOneWithUuidOneTransferWithId($privateCollectionResponseTransfer, $privateTransfer);
    }
}
