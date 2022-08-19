<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppTest\Glue\PrivateBackendApi;

use SprykerTest\Glue\Testify\Tester\ApiEndToEndTester;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class PrivateBackendApiTester extends ApiEndToEndTester
{
    use _generated\AppsBackendApiTesterActions;

    /**
     * @return void
     */
    public function seeResponseJsonContainsPrivate(): void
    {
        $this->seeResponseJsonPathContains(['data' => ['type' => 'private']]);
        $this->seeResponseMatchesJsonType(['data' => ['id' => 'integer:>0', 'attributes' => ['idPrivate' => 'integer:>0', 'uuid' => 'string']]]);
    }
}
