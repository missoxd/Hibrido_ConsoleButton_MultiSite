<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Api;

use Hibrido\Consolebutton\Api\Data\ButtonColorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface ButtonColorRepositoryInterface
{
    /**
     * @param Data\ButtonColorInterface $buttonColor
     * @return Data\ButtonColorInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\ButtonColorInterface $buttonColor): Data\ButtonColorInterface;

    /**
     * @param int $storeview
     * @return ButtonColorInterface
     * @throws NoSuchEntityException
     */
    public function loadByStoreview(int $storeview): ButtonColorInterface;
}
