<?php

namespace Hibrido\Consolebutton\Model\ResourceModel;

use Hibrido\Consolebutton\Api\Data\ButtonColorInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ButtonColor extends AbstractDb
{
    const TABLE_NAME_SOURCE = 'hibrido_button_color';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::TABLE_NAME_SOURCE, ButtonColorInterface::ID);
    }
}
