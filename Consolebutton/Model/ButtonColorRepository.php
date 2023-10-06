<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Model;

use Exception;
use Hibrido\Consolebutton\Api\ButtonColorRepositoryInterface;
use Hibrido\Consolebutton\Api\Data\ButtonColorInterface;
use Hibrido\Consolebutton\Api\Data\ButtonColorSearchResultsInterface;
use Hibrido\Consolebutton\Api\Data\ButtonColorSearchResultsInterfaceFactory;
use Hibrido\Consolebutton\Model\ResourceModel\ButtonColor as ButtonColorResourceModel;
use Hibrido\Consolebutton\Model\ResourceModel\ButtonColor\CollectionFactory as ButtonColorCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\EntityManager\HydratorInterface;
use Magento\Framework\Exception\CouldNotSaveException;

class ButtonColorRepository implements ButtonColorRepositoryInterface
{
    /**
     * @param ButtonColorFactory $buttonColorFactory
     * @param ButtonColorResourceModel $buttonColorResourceModel
     * @param ButtonColorCollectionFactory $buttonColorCollectionFactory
     * @param ButtonColorSearchResultsInterfaceFactory $buttonColorSearchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        private readonly ButtonColorFactory $buttonColorFactory,
        private readonly ButtonColorResourceModel $buttonColorResourceModel,
        private readonly ButtonColorCollectionFactory $buttonColorCollectionFactory,
        private readonly ButtonColorSearchResultsInterfaceFactory $buttonColorSearchResultsFactory,
        private readonly CollectionProcessorInterface $collectionProcessor,
        private readonly HydratorInterface $hydrator
    ) {}

    /**
     * {@inheritdoc}
     */
    public function save(ButtonColorInterface $buttonColor): ButtonColorInterface
    {
        $this->hydrator->hydrate(
            $buttonColorModel = $this->buttonColorFactory->create(),
            $this->hydrator->extract($buttonColor)
        );

        try {
            $this->buttonColorResourceModel->save($buttonColorModel);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $buttonColorModel;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ButtonColorSearchResultsInterface
    {
        $this->collectionProcessor->process(
            $searchCriteria,
            $collection = $this->buttonColorCollectionFactory->create()
        );

        return $this->buttonColorSearchResultsFactory
            ->create()
            ->setSearchCriteria($searchCriteria)
            ->setItems($collection->getItems())
            ->setTotalCount($collection->getSize());
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function loadByStoreview(int $storeview): ButtonColorInterface
//    {
//        $buttonColorModel = $this->buttonColorFactory->create();
//
//        $this->buttonColorResourceModel->load($buttonColorModel, $storeview, 'storeview');
//
//        if (!$buttonColorModel->getId()) {
//            throw new NoSuchEntityException;
//        }
//
//        return $buttonColorModel;
//    }
}
