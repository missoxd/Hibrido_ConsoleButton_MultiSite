<?php

declare(strict_types=1);

namespace Hibrido\Consolebutton\Model;

use Hibrido\Consolebutton\Api\Data\ButtonColorInterface;
use Hibrido\Consolebutton\Model\ResourceModel\ButtonColor as ButtonColorResourceModel;
use Magento\Framework\Model\AbstractModel;

class ButtonColor extends AbstractModel implements ButtonColorInterface
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ButtonColorResourceModel::class);
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->getData(static::COLOR);
    }

    /**
     * @param string $color
     * @return static
     */
    public function setColor(string $color): static
    {
        return $this->setData(static::COLOR, $color);
    }

    /**
     * @return int
     */
    public function getStoreview(): int
    {
        return $this->getData(static::STOREVIEW);
    }

    /**
     * @param int $storeview
     * @return $this
     */
    public function setStoreview(int $storeview): static
    {
        return $this->setData(static::STOREVIEW, $storeview);
    }
}
