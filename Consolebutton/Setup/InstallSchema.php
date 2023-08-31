<?php
namespace Hibrido\Consolebutton\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('hibrido_button_color')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'color',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Color'
        )->addColumn(
            'storeview',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false],
            'Store View'
        )->setComment(
            'Hibrido Color Button Table'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
