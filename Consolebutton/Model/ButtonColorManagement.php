<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Model;

use Hibrido\Consolebutton\Api\ButtonColorManagementInterface;
use Hibrido\Consolebutton\Api\Data\ButtonColorInterface;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\Exception\CouldNotSaveException;

class ButtonColorManagement implements ButtonColorManagementInterface
{
    /**
     * @param ButtonColorFactory $buttonColorFactory
     * @param ButtonColorRepository $buttonColorRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     */
    public function __construct(
        private readonly ButtonColorFactory $buttonColorFactory,
        private readonly ButtonColorRepository $buttonColorRepository,
        private readonly SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
    ) {}

    /**
     * @param int $storeview
     * @param string $color
     * @return bool
     */
    public function changeButtonColorForStoreview(int $storeview, string $color): bool
    {
        $buttonColor = $this->loadButtonColorByStoreviewOrNew($storeview);
        $buttonColor->setColor($color);

        try {
            $this->buttonColorRepository->save($buttonColor);
        } catch (CouldNotSaveException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param int $storeview
     * @return ButtonColorInterface
     */
    private function loadButtonColorByStoreviewOrNew(int $storeview): ButtonColorInterface
    {
        $searchCriteria = $this->searchCriteriaBuilderFactory
            ->create()
            ->addFilter('storeview', $storeview)
            ->setPageSize(1)
            ->setCurrentPage(1)
            ->create();

        $buttonColorItems = $this->buttonColorRepository->getList($searchCriteria);

        if ($buttonColorItems->getTotalCount() === 0) {
            return $this->buttonColorFactory->create();
        }

        return current($buttonColorItems->getItems());
    }
}
