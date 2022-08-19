<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Persistence;

use App\Zed\Private\Persistence\Propel\Private\Mapper\PrivateMapper;
use Orm\Zed\Private\Persistence\SpyPrivateQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \App\Zed\Private\PrivateConfig getConfig()
 * @method \App\Zed\Private\Persistence\PrivateRepositoryInterface getRepository()
 * @method \App\Zed\Private\Persistence\PrivateEntityManagerInterface getEntityManager()
 */
class PrivatePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Private\Persistence\SpyPrivateQuery
     */
    public function createPrivateQuery(): SpyPrivateQuery
    {
        return new SpyPrivateQuery();
    }

    /**
     * @return \App\Zed\Private\Persistence\Propel\Private\Mapper\PrivateMapper
     */
    public function createPrivateMapper(): PrivateMapper
    {
        return new PrivateMapper();
    }
}
