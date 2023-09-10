<?php
namespace Hibrido\Consolebutton\Model;

use Magento\Framework\Model\AbstractModel;

class ButtonColor extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Hibrido\Consolebutton\Model\ResourceModel\ButtonColor::class);
    }
}