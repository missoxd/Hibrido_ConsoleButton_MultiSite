<?php

namespace Hibrido\Consolebutton\Model;

use Hibrido\Consolebutton\Model\ResourceModel\ButtonColor as ButtonColorResourceModel;
use Magento\Framework\Model\AbstractModel;

class ButtonColor extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ButtonColorResourceModel::class);
    }
}
