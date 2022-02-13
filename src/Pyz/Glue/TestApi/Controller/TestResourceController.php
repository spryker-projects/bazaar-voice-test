<?php

namespace Pyz\Glue\TestApi\Controller;

use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Generated\Shared\Transfer\TestCollectionRequestTransfer;
use Generated\Shared\Transfer\TestConditionsTransfer;
use Generated\Shared\Transfer\TestCriteriaTransfer;
use Generated\Shared\Transfer\TestTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractBackendApiController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Pyz\Glue\TestApi\TestApiFactory getFactory()
 */
class TestResourceController extends AbstractBackendApiController
{
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $testCriteriaTransfer = new TestCriteriaTransfer();

        $testCriteriaTransfer->setPagination($glueRequestTransfer->getPagination());
        $testCriteriaTransfer->setSortCollection($glueRequestTransfer->getSortings());

        $conditionsTransfer = new TestConditionsTransfer();
        if(isset($glueRequestTransfer->getQueryFields()['filter'])) {
            foreach($glueRequestTransfer->getQueryFields()['filter'] as $name => $value) {
                if($name === 'name') {
                    $conditionsTransfer->setNames(explode(',', $value));
                }

                if($name === 'id') {
                    $conditionsTransfer->addTestId($value);
                }

            }
        }

        $testCriteriaTransfer->setTestConditions($conditionsTransfer);
        $testCollectionTransfer = $this->getFactory()->getTestFacade()->getTestCollection($testCriteriaTransfer);

        $glueResponseTransfer = new GlueResponseTransfer();
        foreach($testCollectionTransfer->getTests() as $test) {
            $resourceTransfer = new GlueResourceTransfer();
            $resourceTransfer->setAttributes($test);
            $resourceTransfer->setId($test->getId());
            $resourceTransfer->setType('test');

            $glueResponseTransfer->addResource($resourceTransfer);
        }

        return $glueResponseTransfer;
    }

    public function getAction(string $id): GlueResponseTransfer
    {
        $test = '';
    }

    public function postAction(TestTransfer $testTransfer, GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $testCollectionRequestTransfer = new TestCollectionRequestTransfer();
        $testCollectionRequestTransfer->addTest($testTransfer)->setIsTransactional(false);

        $testCollectionResponseTransfer = $this->getFactory()->getTestFacade()->createTestCollection($testCollectionRequestTransfer);

        $glueResponseTransfer = new GlueResponseTransfer();
        if(!(array)$testCollectionResponseTransfer->getErrors()) {
            $resourceTransfer = new GlueResourceTransfer();
            $resourceTransfer->setAttributes($testCollectionResponseTransfer->getTests()->offsetGet(0));
            $resourceTransfer->setId($testCollectionResponseTransfer->getTests()->offsetGet(0)->getId());
            $resourceTransfer->setType('test');

            $glueResponseTransfer->addResource($resourceTransfer);

            return $glueResponseTransfer;
        }

        foreach($testCollectionResponseTransfer->getErrors() as $error) {
            $glueResponseTransfer->addError((new GlueErrorTransfer())->setMessage($error->getMessage()));
        }

        return $glueResponseTransfer;
    }

    public function patchAction(TestTransfer $testTransfer): GlueResponseTransfer
    {
        $test = '';
    }

    public function deleteAction(string $id): GlueResponseTransfer
    {
        $test = '';
    }
}