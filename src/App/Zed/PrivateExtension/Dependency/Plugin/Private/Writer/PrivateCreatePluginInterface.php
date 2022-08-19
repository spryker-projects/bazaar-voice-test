<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\PrivateExtension\Dependency\Plugin\Private\Writer;

interface PrivateCreatePluginInterface
{
    /**
     * Specification:
     * - Executes plugin for `PrivateTransfer[]` before or after create them.
     * - Returns mapped `PrivateTransfer[]`.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\PrivateTransfer> $privateTransfers
     *
     * @return array<\Generated\Shared\Transfer\PrivateTransfer>
     */
    public function execute(array $privateTransfers): array;
}
