<?php
namespace Hibrido\Consolebutton\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ButtonColor extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mage_hibrido_button_color', 'id');
    }
}