<?php
namespace Hibrido\Consolebutton\Model\ResourceModel\ButtonColor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Hibrido\Consolebutton\Model\ButtonColor::class,
            \Hibrido\Consolebutton\Model\ResourceModel\ButtonColor::class
        );
    }
}
