<?php

declare(strict_types=1);

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
        $this->_init(static::TABLE_NAME_SOURCE, ButtonColorInterface::ID);
    }

    private function getBlockId(AbstractModel $object, $value, $field = null)
    {
        $entityMetadata = $this->metadataPool->getMetadata(BlockInterface::class);
        if (!is_numeric($value) && $field === null) {
            $field = 'identifier';
        } elseif (!$field) {
            $field = $entityMetadata->getIdentifierField();
        }
        $entityId = $value;
        if ($field != $entityMetadata->getIdentifierField() || $object->getStoreId()) {
            $select = $this->_getLoadSelect($field, $value, $object);
            $select->reset(Select::COLUMNS)
                ->columns($this->getMainTable() . '.' . $entityMetadata->getIdentifierField())
                ->limit(1);
            $result = $this->getConnection()->fetchCol($select);
            $entityId = count($result) ? $result[0] : false;
        }
        return $entityId;
    }
}
