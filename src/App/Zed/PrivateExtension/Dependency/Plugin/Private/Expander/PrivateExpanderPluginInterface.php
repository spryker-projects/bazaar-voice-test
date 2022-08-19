<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\PrivateExtension\Dependency\Plugin\Private\Expander;

interface PrivateExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands `PrivateTransfer[]` after reading them.
     * - Returns expanded `PrivateTransfer[]`.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\PrivateTransfer> $privateTransfers
     *
     * @return array<\Generated\Shared\Transfer\PrivateTransfer>
     */
    public function expand(array $privateTransfers): array;
}
