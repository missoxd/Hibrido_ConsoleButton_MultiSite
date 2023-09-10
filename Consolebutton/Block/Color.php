<?php
namespace Hibrido\Consolebutton\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Hibrido\Consolebutton\Model\ButtonColorFactory;
use Magento\Framework\App\ResourceConnection;

class Color extends \Magento\Framework\View\Element\Template
{
    protected const TABLE_NAME = 'hibrido_button_color';

    protected $storeManager;
    protected $buttonColorFactory;
    protected $resourceConnection;
    protected $connection;

    public function __construct(
        ButtonColorFactory $buttonColorFactory,
        Context $context,
        StoreManagerInterface $storeManager,
        ResourceConnection $resourceConnection,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->buttonColorFactory = $buttonColorFactory;
        $this->resourceConnection = $resourceConnection;
        parent::__construct($context, $data);
        $this->connection = $this->resourceConnection->getConnection();
    }

    public function getCurrentStoreId()
    {
        $currentStoreView = $this->storeManager->getStore()->getStoreId();
        return $currentStoreView;
    }

    public function getStoreViewsDB()
    {
        $select = $this->connection->select()->from($this::TABLE_NAME, 'storeview');
        $result = $this->connection->fetchAll($select);

        $storeViews = [];
        foreach ($result as $row) {
            $storeViews[] = $row['storeview'];
        }
        return $storeViews;
    }

    public function getButtonColor($storeView){
        $select = $this->connection->select()->from($this::TABLE_NAME, 'color')->where('storeview = ?', $storeView);
        $result = $this->connection->fetchRow($select);
        return $result['color'];
    }
}
