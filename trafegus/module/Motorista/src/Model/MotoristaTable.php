<?php

namespace Motorista\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;
use RuntimeException;

class motoristaTable {

    private  $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getAll(){
        return $this->tableGateway->select();
    }

    public function getMotorista($id) {
        $id = (int) $id;

        $rowset  = $this->tableGateway->select(['id' => $id]);

        $row = $rowset->current();

        if (!$row) {
            throw new RuntimeException(sprintf('Nao foi encontrado o id %d', $id));
        }

        return $row;
    }

    public function getMotoristaTeste() {
        $select = $this->tableGateway->getSql()->select();
        $select->join(
            'veiculo',
            'motorista.veiculo_id = veiculo.id',
            ['placa', 'modelo'],
            Select::JOIN_LEFT
        );
    
        $rowset = $this->tableGateway->selectWith($select);
        
        return $rowset;
    }

    public function salvarMotorista(Motorista $motorista) {

        $data = [
            'nome' => $motorista->getNome(), 
            'rg' => $motorista->getRg(),
            'cpf' => $motorista->getCpf(), 
            'telefone' => $motorista->getTelefone(), 
            'veiculo_id' => $motorista->getVeiculoId(), 
        ];

        $id = (int) $motorista->getId();

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        $this->tableGateway->update($data, ['id' => $id]);
    
    }

    public function deletarMotorista($id) {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}