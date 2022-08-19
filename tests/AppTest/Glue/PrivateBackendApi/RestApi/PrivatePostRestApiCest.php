<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppTest\Glue\PrivateBackendApi\RestApi;

use _Spryk_2760be2a\Symfony\Component\HttpFoundation\Response;
use AppTest\Glue\PrivateBackendApi\PrivateBackendApiTester;

/**
 * Auto-generated group annotations
 *
 * @group AppTest
 * @group Glue
 * @group PrivateBackendApi
 * @group PrivatePostRestApiCest
 */
class PrivatePostRestApiCest
{
    /**
     * @param \AppTest\Glue\PrivateBackendApi\PrivateBackendApiTester $I
     *
     * @return void
     */
    public function requestPrivatePostReturnsHttpResponseCode200(PrivateBackendApiTester $I): void
    {
        // Arrange
        $url = $I->buildPrivateUrl();
        // Act
        $I->sendPost($url);
        // Assert
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonContainsPrivate();
    }

    /**
     * @param \AppTest\Glue\PrivateBackendApi\PrivateBackendApiTester $I
     *
     * @return void
     */
    public function requestPrivatePostReturnsHttpResponseCode400(PrivateBackendApiTester $I): void
    {
        // Arrange
        $url = $I->buildPrivateUrl();
        // Act
        $I->sendPost($url);
        // Assert
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseJsonContainsPrivate();
    }

    /**
     * @param \AppTest\Glue\PrivateBackendApi\PrivateBackendApiTester $I
     *
     * @return void
     */
    public function requestPrivatePostReturnsHttpResponseCode204(PrivateBackendApiTester $I): void
    {
        // Arrange
        $url = $I->buildPrivateUrl();
        // Act
        $I->sendPost($url);
        // Assert
        $I->seeResponseCodeIs(Response::HTTP_NO_CONTENT);
        $I->seeResponseIsJson();
        $I->seeResponseJsonContainsPrivate();
    }
}
