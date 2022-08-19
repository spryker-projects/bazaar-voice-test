<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Persistence;

use Generated\Shared\Transfer\PrivateTransfer;

interface PrivateEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function createPrivate(PrivateTransfer $privateTransfer): PrivateTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function updatePrivate(PrivateTransfer $privateTransfer): PrivateTransfer;

    /**
     * @param \Generated\Shared\Transfer\PrivateTransfer $privateTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateTransfer
     */
    public function deletePrivate(PrivateTransfer $privateTransfer): PrivateTransfer;
}
