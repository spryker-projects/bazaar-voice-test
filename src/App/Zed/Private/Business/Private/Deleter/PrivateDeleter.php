<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace App\Zed\Private\Business\Private\Deleter;

use App\Zed\Private\Persistence\PrivateEntityManagerInterface;
use App\Zed\Private\Persistence\PrivateRepositoryInterface;
use Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\PrivateCollectionResponseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class PrivateDeleter implements PrivateDeleterInterface
{
    use TransactionTrait;

    /**
     * @var \App\Zed\Private\Persistence\PrivateEntityManagerInterface
     */
    protected PrivateEntityManagerInterface $privateEntityManager;

    /**
     * @var \App\Zed\Private\Persistence\PrivateRepositoryInterface
     */
    protected PrivateRepositoryInterface $privateRepository;

    /**
     * @param \App\Zed\Private\Persistence\PrivateEntityManagerInterface $privateEntityManager
     * @param \App\Zed\Private\Persistence\PrivateRepositoryInterface $privateRepository
     */
    public function __construct(
        PrivateEntityManagerInterface $privateEntityManager,
        PrivateRepositoryInterface $privateRepository
    ) {
        $this->privateEntityManager = $privateEntityManager;
        $this->privateRepository = $privateRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    public function deletePrivateCollection(PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer): PrivateCollectionResponseTransfer
    {
        return $this->getTransactionHandler()->handleTransaction(function () use ($privateCollectionDeleteCriteriaTransfer) {
            return $this->executeDeletePrivateCollectionTransaction($privateCollectionDeleteCriteriaTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PrivateCollectionResponseTransfer
     */
    protected function executeDeletePrivateCollectionTransaction(
        PrivateCollectionDeleteCriteriaTransfer $privateCollectionDeleteCriteriaTransfer
    ): PrivateCollectionResponseTransfer {
        $privateCollectionTransfer = $this->privateRepository->getPrivateDeleteCollection($privateCollectionDeleteCriteriaTransfer);

        $privateCollectionResponseTransfer = new PrivateCollectionResponseTransfer();

        foreach ($privateCollectionTransfer->getPrivates() as $privateTransfer) {
            $privateCollectionResponseTransfer->addPrivate(
                $this->privateEntityManager->deletePrivate($privateTransfer),
            );
        }

        return $privateCollectionResponseTransfer;
    }
}
