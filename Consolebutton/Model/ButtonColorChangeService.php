<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Model;

use Hibrido\Consolebutton\Api\ButtonColorChangeServiceInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class ButtonColorChangeService implements ButtonColorChangeServiceInterface
{
    /**
     * @var ButtonColorFactory
     */
    private ButtonColorFactory $buttonColorFactory;

    /**
     * @var ButtonColorRepository
     */
    private ButtonColorRepository $buttonColorRepository;

    /**
     * @param ButtonColorFactory $buttonColorFactory
     * @param ButtonColorRepository $buttonColorRepository
     */
    public function __construct(
        ButtonColorFactory $buttonColorFactory,
        ButtonColorRepository $buttonColorRepository
    ) {
        $this->buttonColorRepository = $buttonColorRepository;
        $this->buttonColorFactory = $buttonColorFactory;
    }

    /**
     * @param int $storeview
     * @param string $color
     * @return bool
     */
    public function execute(int $storeview, string $color): bool
    {
        try {
            $buttonColor = $this->buttonColorRepository->loadByStoreview($storeview);
        } catch (NoSuchEntityException $e) {
            $buttonColor = $this->buttonColorFactory->create();
        }

        $buttonColor->setColor($color);
        $buttonColor->setStoreview($storeview);

        try {
            $this->buttonColorRepository->save($buttonColor);
        } catch (CouldNotSaveException $e) {
            return false;
        }

        return true;
    }
}
