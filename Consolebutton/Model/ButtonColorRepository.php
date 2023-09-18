<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Model;

use Exception;
use Hibrido\Consolebutton\Api\ButtonColorRepositoryInterface;
use Hibrido\Consolebutton\Api\Data\ButtonColorInterface;
use Hibrido\Consolebutton\Model\ResourceModel\ButtonColor as ButtonColorResourceModel;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class ButtonColorRepository implements ButtonColorRepositoryInterface
{
    /**
     * @var ButtonColorFactory
     */
    private ButtonColorFactory $buttonColorFactory;

    /**
     * @var ButtonColorResourceModel
     */
    private ButtonColorResourceModel $buttonColorResourceModel;

    /**
     * @param ButtonColorFactory $buttonColorFactory
     * @param ButtonColorResourceModel $buttonColorResourceModel
     */
    public function __construct(
        ButtonColorFactory $buttonColorFactory,
        ButtonColorResourceModel $buttonColorResourceModel
    ) {
        $this->buttonColorFactory = $buttonColorFactory;
        $this->buttonColorResourceModel = $buttonColorResourceModel;
    }

    /**
     * @param ButtonColorInterface $buttonColor
     * @return ButtonColorInterface
     * @throws CouldNotSaveException
     */
    public function save(ButtonColorInterface $buttonColor): ButtonColorInterface
    {
        // Hydrator não utilizado para manter a simplicidade

        $buttonColorModel = $this->buttonColorFactory->create();

        if ($buttonColor->getId()) {
            $buttonColorModel->setId($buttonColor->getId());
        }

        $buttonColorModel->setColor($buttonColor->getColor());
        $buttonColorModel->setStoreview($buttonColor->getStoreview());

        try {
            $this->buttonColorResourceModel->save($buttonColorModel);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        $buttonColor->setId($buttonColorModel->getId());

        return $buttonColor;
    }

    /**
     * @param int $storeview
     * @return ButtonColorInterface
     * @throws NoSuchEntityException
     */
    public function loadByStoreview(int $storeview): ButtonColorInterface
    {
        $buttonColorModel = $this->buttonColorFactory->create();

        $this->buttonColorResourceModel->load($buttonColorModel, $storeview, 'storeview');

        if (!$buttonColorModel->getId()) {
            throw new NoSuchEntityException;
        }

        return $buttonColorModel;
    }
}
