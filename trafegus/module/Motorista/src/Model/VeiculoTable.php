<?php

namespace Motorista\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class veiculoTable {

    private  $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getAll(){
        return $this->tableGateway->select();
    }

    public function getVeiculosAsArray() {
        $resultSet = $this->tableGateway->select();
        $veiculos = [];
        foreach ($resultSet as $veiculo) {
            $veiculos[$veiculo->getId()] = $veiculo->getPlaca();
        }
        return $veiculos;
    }

    public function getVeiculo($id) {
        $id = (int) $id;

        $rowset  = $this->tableGateway->select(['id' => $id]);

        $row = $rowset->current();

        if (!$row) {
            throw new RuntimeExcepetion(sprintf('Nao foi encontrado o id %d', $id));
        }

        return $row;
    }

    public function salvarVeiculo(Veiculo $veiculo) {

        $data = [
            'placa' => $veiculo->getPlaca(), 
            'renavam' => $veiculo->getRenavam(), 
            'modelo' => $veiculo->getModelo(), 
            'marca' => $veiculo->getMarca(), 
            'ano' => $veiculo->getAno(), 
            'cor' => $veiculo->getCor(), 
        ];

        $id = (int) $veiculo->getId();

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        $this->tableGateway->update($data, ['id' => $id]);
    
    }

    public function deletarVeiculo($id) {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}