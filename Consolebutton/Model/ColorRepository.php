<?php

namespace Hibrido\Consolebutton\Model;

use Hibrido\Consolebutton\Api\ColorRepositoryInterface;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * Implementação da interface ColorRepositoryInterface.
 */
class ColorRepository implements ColorRepositoryInterface
{
    const TABLE_NAME = 'hibrido_button_color';

    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context O contexto do recurso do banco de dados.
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * @return array Uma lista de store views.
     */
    public function getAllStoreviews(){
        return $this->getColumns('storeview', $this->getConnection());
    }

    /**
     * @return array Uma lista de cores.
     */
    public function getAllColor(){
        return $this->getColumns('color', $this->getConnection());
    }

    /**
     * @param string $storeView A store view a ser associada à cor.
     * @param string $newColor A nova cor a ser salva.
     */
    public function saveColor($storeView, $newColor)
    {
        $connection = $this->getConnection();

        $data = [
            'color' => $newColor,
            'storeview' => $storeView
        ];

        if ($this->storeviewExists($storeView)) {
            $where = ['storeview = ?' => $storeView];
            $connection[0]->update($connection[1], $data, $where);
        } else {
            $connection[0]->insert($connection[1], $data);
        }
    }

    /**
     * @param string $storeView A store view a ser verificada.
     * @return bool True se a store view existe, false caso contrário.
     */
    public function storeviewExists($storeView)
    {
        $connection = $this->getConnection();

        $select = $connection[0]->select()
            ->from($connection[1])
            ->where('storeview = ?', $storeView);

        $query = $connection[0]->query($select);
        $result = $query->fetchAll();

        return count($result) > 0;
    }

    /**
     * @return array Um array contendo a conexão e o nome da tabela.
     */
    protected function getConnection(){
        $connection = $this->context->getResources()->getConnection();
        $tableName = $this->context->getResources()->getTableName(SELF::TABLE_NAME);
        
        return[$connection, $tableName];
    }

    /**
     * @param string $ColumnName Coluna a ser recuperada.
     * @param array $connection A conexão com o banco de dados e o nome da tabela.
     * @return array
     */
    protected function getColumns($ColumnName, $connection){
        $select = $connection[0]->select()
            ->from($connection[1], [$ColumnName]);
        $query = $connection[0]->query($select);
        $result = $query->fetchAll();

        return $result;
    }
}
