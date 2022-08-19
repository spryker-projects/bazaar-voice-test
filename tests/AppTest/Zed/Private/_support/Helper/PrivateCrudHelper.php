<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppTest\Zed\Private\Helper;

use App\Zed\Private\Business\PrivateFacadeInterface;
use App\Zed\PrivateExtension\Dependency\Plugin\Private\Expander\PrivateExpanderPluginInterface;
use App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateCreatePluginInterface;
use App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface;
use Codeception\Module;
use Generated\Shared\DataBuilder\PrivateBuilder;
use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionRequestTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Generated\Shared\Transfer\PrivateCollectionTransfer;
use Generated\Shared\Transfer\PrivateConditionsTransfer;
use Generated\Shared\Transfer\PrivateCriteriaTransfer;
use Generated\Shared\Transfer\PrivateTransfer;
use SprykerTest\Zed\Testify\Helper\Business\BusinessHelperTrait;

class PrivateCrudHelper extends Module
{
    use BusinessHelperTrait;

    /**
     * @var string
     */
    protected const UUID_ONE = 'ebad5042-0db1-498e-9981-42f45f98ad3d';

    /**
     * @var string
     */
    protected const UUID_TWO = 'b7b94e0f-ec4d-4341-9132-07342b45f659';

    /**
     * @return \Generated\Shared\Transfer\PrivateTransfer|null
     */
    public function havePrivateTransferWithUuidTwoPersisted(): ?PrivateTransfer
    {
        return $this->persistPrivate($this->havePrivateTransfer(['uuid' => static::UUID_TWO]));
    }

    /**
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function havePrivateTransferWithUuidTwo(): PrivateTransfer
    {
        return $this->havePrivateTransfer(['uuid' => static::UUID_ONE]);
    }

    /**
     * @return \Generated\Shared\Transfer\PrivateTransfer|null
     */
    public function havePrivateTransferWithUuidOnePersisted(): ?PrivateTransfer
    {
        return $this->persistPrivate($this->havePrivateTransfer(['uuid' => static::UUID_ONE]));
    }

    /**
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function havePrivateTransferWithUuidOne(): PrivateTransfer
    {
        return $this->havePrivateTransfer(['uuid' => static::UUID_ONE]);
    }

    /**
     * @param array<string, mixed> $seed
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function havePrivateTransfer(array $seed = []): PrivateTransfer
    {
        $privateBuilder = new PrivateBuilder($seed);

        return $privateBuilder->build();
    }

    /**
     * @return \Generated\Shared\Transfer\PrivateCriteriaTransfer
     */
    public function havePrivateCriteriaTransferWithUuidOneCriteria(): PrivateCriteriaTransfer
    {
        $privateCriteriaTransfer = new PrivateCriteriaTransfer();
        $privateConditionsTransfer = new PrivateConditionsTransfer();
        $privateConditionsTransfer->setUuids([static::UUID_ONE]);
        $privateCriteriaTransfer->setPrivateConditions($privateConditionsTransfer);

        return $privateCriteriaTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer
     */
    public function havePrivateDeleteCriteriaTransferWithUuidOneCriteria(): PrivateCollectionDeleteCriteriaTransfer
    {
        $privateCollectionDeleteCriteriaTransfer = new PrivateCollectionDeleteCriteriaTransfer();
        $privateCollectionDeleteCriteriaTransfer->setUuids([static::UUID_ONE]);

        return $privateCollectionDeleteCriteriaTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer
     */
    public function havePrivateDeleteCriteriaTransferWithUuidTwoCriteria(): PrivateCollectionDeleteCriteriaTransfer
    {
        $privateCollectionDeleteCriteriaTransfer = new PrivateCollectionDeleteCriteriaTransfer();
        $privateCollectionDeleteCriteriaTransfer->setUuids([static::UUID_TWO]);

        return $privateCollectionDeleteCriteriaTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\PrivateCriteriaTransfer
     */
    public function havePrivateCriteriaTransferWithUuidTwoCriteria(): PrivateCriteriaTransfer
    {
        $privateCriteriaTransfer = new PrivateCriteriaTransfer();
        $privateConditionsTransfer = new PrivateConditionsTransfer();
        $privateConditionsTransfer->setUuids([static::UUID_TWO]);
        $privateCriteriaTransfer->setPrivateConditions($privateConditionsTransfer);

        return $privateCriteriaTransfer;
    }

    /**
     * @param array<string, mixed> $seed
     *
     * @return \Generated\Shared\Transfer\AppTransfer|null
     */
    public function havePrivateTransferPersisted(array $seed = []): ?AppTransfer
    {
        return $this->persistPrivate($this->havePrivateTransfer($seed));
    }

    /**
     * @return void
     */
    public function havePrivateExpanderPluginSetUuidTwoEnabled(): void
    {
        $privateExpanderPluginSetUuidTwo = new class (static::UUID_TWO) implements PrivateExpanderPluginInterface {
           /**
            * @var string
            */
            private $uuid;

           /**
            * @param string $uuid
            */
            public function __construct(string $uuid)
            {
                $this->uuid = $uuid;
            }

            /**
             * @param array<\Generated\Shared\Transfer\PrivateTransfer> $privateTransfers
             *
             * @return array<\Generated\Shared\Transfer\PrivateTransfer>
             */
            public function expand(array $privateTransfers): array
            {
                foreach ($privateTransfers as $privateTransfer) {
                    $privateTransfer->setUuid($this->uuid);
                }

                return $privateTransfers;
            }
        };

        $this->getBusinessHelper()->mockFactoryMethod('getPrivateExpanderPlugins', [$privateExpanderPluginSetUuidTwo], 'Private');
    }

    /**
     * @return void
     */
    public function havePrivatePreCreatePluginSetUuidTwoEnabled(): void
    {
        $privatePreCreatePlugin = $this->mockCreatePlugin();

        $this->getBusinessHelper()->mockFactoryMethod('getPrivatePreCreatePlugins', [$privatePreCreatePlugin], 'Private');
    }

    /**
     * @return void
     */
    public function havePrivatePostCreatePluginSetUuidTwoEnabled(): void
    {
        $privatePostCreatePlugin = $this->mockCreatePlugin();

        $this->getBusinessHelper()->mockFactoryMethod('getPrivatePostCreatePlugins', [$privatePostCreatePlugin], 'Private');
    }

    /**
     * @return void
     */
    public function havePrivatePreUpdatePluginSetUuidTwoEnabled(): void
    {
        $privatePreUpdatePlugin = $this->mockUpdatePlugin();

        $this->getBusinessHelper()->mockFactoryMethod('getPrivatePreUpdatePlugins', [$privatePreUpdatePlugin], 'Private');
    }

    /**
     * @return void
     */
    public function havePrivatePostUpdatePluginSetUuidTwoEnabled(): void
    {
        $privatePostUpdatePlugin = $this->mockUpdatePlugin();

        $this->getBusinessHelper()->mockFactoryMethod('getPrivatePostUpdatePlugins', [$privatePostUpdatePlugin], 'Private');
    }

    /**
     * @return void
     */
    public function havePrivateAlwaysFailingCreateValidatorRuleEnabled(): void
    {
        $this->mockPrivateAlwaysFailingValidatorRule('getPrivateCreateValidatorRules');
    }

    /**
     * @return void
     */
    public function havePrivateAlwaysFailingUpdateValidatorRuleEnabled(): void
    {
        $this->mockPrivateAlwaysFailingValidatorRule('getPrivateUpdateValidatorRules');
    }

    /**
     * @return void
     */
    public function havePrivateAlwaysFailingCreateValidatorRulePluginEnabled(): void
    {
        $this->mockPrivateAlwaysFailingValidatorRule('getPrivateCreateValidatorRulePlugins');
    }

    /**
     * @return void
     */
    public function havePrivateAlwaysFailingUpdateValidatorRulePluginEnabled(): void
    {
        $this->mockPrivateAlwaysFailingValidatorRulePlugin('getPrivateUpdateValidatorRulePlugins');
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
     *
     * @return void
     */
    public function assertPrivateCollectionIsEmpty(PrivateCollectionTransfer $privateCollectionTransfer): void
    {
        $this->assertCount(0, $privateCollectionTransfer->getPrivates(), sprintf('Expected to have an empty collection but found "%s" items', $privateCollectionTransfer->getPrivates()->count()));
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     *
     * @return void
     */
    public function assertPrivateCollectionResponseIsEmpty(PrivateCollectionResponseTransfer $privateCollectionResponseTransfer): void
    {
        $this->assertCount(0, $privateCollectionResponseTransfer->getPrivates(), sprintf('Expected to have an empty response collection but found "%s" items', $privateCollectionResponseTransfer->getPrivates()->count()));
    }

   /**
    * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
    *
    * @return void
    */
    public function assertPrivateCollectionResponseContainsOneWithUuidOneTransferWithId(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer,
        PrivateTransfer $privateTransfer
    ): void {
        $privateCollectionTransfer = (new PrivateCollectionTransfer())->setPrivates($privateCollectionResponseTransfer->getPrivates());

        $this->assertPrivateCollectionContainsTransferWithId($privateCollectionTransfer, $privateTransfer);
        $this->assertPrivateCollectionResponseContainsOneWithUuidOneTransfer($privateCollectionResponseTransfer);
    }

   /**
    * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    *
    * @return void
    */
    public function assertPrivateCollectionResponseContainsOneWithUuidOneTransfer(PrivateCollectionResponseTransfer $privateCollectionResponseTransfer): void
    {
        $this->assertCount(1, $privateCollectionResponseTransfer->getPrivates());
        $this->assertEquals(static::UUID_ONE, $privateCollectionResponseTransfer->getPrivates()[0]->getUuid());
    }

   /**
    * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
    *
    * @return void
    */
    public function assertPrivateCollectionResponseContainsOneWithUuidTwoTransferWithId(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer,
        PrivateTransfer $privateTransfer
    ): void {
        $privateCollectionTransfer = (new PrivateCollectionTransfer())->setPrivates($privateCollectionResponseTransfer->getPrivates());

        $this->assertPrivateCollectionContainsTransferWithId($privateCollectionTransfer, $privateTransfer);
        $this->assertPrivateCollectionResponseContainsOneWithUuidTwoTransfer($privateCollectionResponseTransfer);
    }

   /**
    * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
    *
    * @return void
    */
    public function assertPrivateCollectionResponseContainsOneWithUuidTwoTransfer(PrivateCollectionResponseTransfer $privateCollectionResponseTransfer): void
    {
        $this->assertCount(1, $privateCollectionResponseTransfer->getPrivates());
        $this->assertEquals(static::UUID_TWO, $privateCollectionResponseTransfer->getPrivates()[0]->getUuid());
    }

   /**
    * @param \Generated\Shared\Transfer\PrivateCollectionTransfer $privateCollectionTransfer
    * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
    *
    * @return void
    */
    public function assertPrivateCollectionContainsTransferWithId(PrivateCollectionTransfer $privateCollectionTransfer, PrivateTransfer $privateTransfer): void
    {
        $transferFound = false;

        foreach ($privateCollectionTransfer->getPrivates() as $privateTransferFromCollection) {
            if ($privateTransferFromCollection->getIdPrivate() === $privateTransfer->getIdPrivate()) {
                $transferFound = true;
            }
        }

        $this->assertTrue($transferFound, sprintf('Expected to have a transfer in the collection but transfer by id "%s" was not found in the collection', $privateTransfer->getIdPrivate()));
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionResponseTransfer $privateCollectionResponseTransfer
     * @param string $message
     *
     * @return void
     */
    public function assertPrivateCollectionResponseContainsFailedValidationRuleError(
        PrivateCollectionResponseTransfer $privateCollectionResponseTransfer,
        string $message = 'Validation failed'
    ): void {
        $errorFound = false;

        foreach ($privateCollectionResponseTransfer->getErrors() as $errorTransfer) {
            if ($errorTransfer->getMessage() === $message) {
                $errorFound = true;
            }
        }

        $this->assertTrue($errorFound, sprintf('Expected to have a message "%s" in the error collection but was not found', $message));
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer|null
     */
    protected function persistPrivate(PrivateTransfer $privateTransfer): ?PrivateTransfer
    {
        $privateCollectionRequestTransfer = new PrivateCollectionRequestTransfer();
        $privateCollectionRequestTransfer->addPrivate($privateTransfer);

        $privateCollectionResponseTransfer = $this->getFacade()->createPrivateCollection($privateCollectionRequestTransfer);

        return $privateCollectionResponseTransfer->getPrivates()->getIterator()->current();
    }

    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateCreatePluginInterface
     */
    protected function mockCreatePlugin(): PrivateCreatePluginInterface
    {
        return new class (static::UUID_TWO) implements \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateCreatePluginInterface {
            /**
             * @var string
             */
            private $uuid;

            /**
             * @param string $uuid
             */
            public function __construct(string $uuid)
            {
                $this->uuid = $uuid;
            }

            /**
             * @param array<\Generated\Shared\Transfer\PrivateTransfer> $privateTransfers
             *
             * @return array<\Generated\Shared\Transfer\PrivateTransfer>
             */
            public function execute(array $privateTransfers): array
            {
                foreach ($privateTransfers as $privateTransfer) {
                    $privateTransfer->setUuid($this->uuid);
                }

                return $privateTransfers;
            }
        };
    }

    /**
     * @return \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface
     */
    protected function mockUpdatePlugin(): PrivateUpdatePluginInterface
    {
        return new class (static::UUID_TWO) implements \App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer\PrivateUpdatePluginInterface {
           /**
            * @var string
            */
            private $uuid;

           /**
            * @param string $uuid
            */
            public function __construct(string $uuid)
            {
                $this->uuid = $uuid;
            }

           /**
            * @param array<\Generated\Shared\Transfer\PrivateTransfer> $privateTransfers
            *
            * @return array<\Generated\Shared\Transfer\PrivateTransfer>
            */
            public function execute(array $privateTransfers): array
            {
                foreach ($privateTransfers as $privateTransfer) {
                    $privateTransfer->setUuid($this->uuid);
                }

                return $privateTransfers;
            }
        };
    }

    /**
     * @param string $factoryMethod
     *
     * @return void
     */
    protected function mockPrivateAlwaysFailingValidatorRule(string $factoryMethod): void
    {
        $privateValidatorRule = new class implements \App\Zed\Private\Business\Private\Validator\Rules\PrivateValidatorRuleInterface {
            /**
             * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
             *
             * @return array<string>
             */
            public function validate(PrivateTransfer $privateTransfer): array
            {
                return ['Validation failed'];
            }
        };

        $this->getBusinessHelper()->mockFactoryMethod($factoryMethod, [$privateValidatorRule], 'Private');
    }

    /**
     * @param string $factoryMethod
     *
     * @return void
     */
    protected function mockPrivateAlwaysFailingValidatorRulePlugin(string $factoryMethod): void
    {
        $privateValidatorRulePlugin = new class implements \App\Zed\PrivateExtension\Dependency\Plugin\Private\Validator\PrivateValidatorRulePluginInterface {
            /**
             * @param \Generated\Shared\Transfer\PrivateTransfer|array $privateTransfer
             *
             * @return array<string>
             */
            public function validate(PrivateTransfer $privateTransfer): array
            {
                return ['Validation failed'];
            }
        };

        $this->getBusinessHelper()->mockFactoryMethod($factoryMethod, [$privateValidatorRulePlugin], 'Private');
    }

    /**
     * @return \App\Zed\Private\Business\PrivateFacadeInterface
     */
    protected function getFacade(): PrivateFacadeInterface
    {
        /** @var \App\Zed\Private\Business\PrivateFacadeInterface */
        return $this->getBusinessHelper()->getFacade('Private');
    }
}
