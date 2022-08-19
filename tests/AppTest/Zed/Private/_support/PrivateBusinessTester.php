<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppTest\Zed\Private;

use Codeception\Actor;

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
 *
 * @method \App\Zed\Private\Business\PrivateFacadeInterface getFacade(?string $moduleName = null)
 */
class PrivateBusinessTester extends Actor
{
    use _generated\PrivateBusinessTesterActions;
}
