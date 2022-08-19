<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Writer;

use Generated\Shared\Transfer\PrivateCollectionRequestTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;

interface PrivateCreatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function createPrivateCollection(
        PrivateCollectionRequestTransfer $privateCollectionRequestTransfer
    ): PrivateCollectionResponseTransfer;
}
