<?php

namespace Hibrido\Consolebutton\Model\ResourceModel\ButtonColor;

use Hibrido\Consolebutton\Model\ButtonColor;
use Hibrido\Consolebutton\Model\ResourceModel\ButtonColor as ButtonColorResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ButtonColor::class, ButtonColorResourceModel::class);
    }
}
