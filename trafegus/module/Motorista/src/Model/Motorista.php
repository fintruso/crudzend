<?php 

namespace Motorista\Model;

class Motorista implements \Zend\Stdlib\ArraySerializableInterface{

    private $id;
    private $nome;
    private $rg;
    private $cpf;
    private $telefone;
    private $veiculo_id;
    private $placa;
    private $modelo;

    public function exchangeArray(array $data){

        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->nome = !empty($data['nome']) ? $data['nome'] : null;
        $this->rg = !empty($data['rg']) ? $data['rg'] : null;
        $this->cpf = !empty($data['cpf']) ? $data['cpf'] : null;
        $this->telefone = !empty($data['telefone']) ? $data['telefone'] : null;
        $this->veiculo_id = !empty($data['veiculo_id']) ? $data['veiculo_id'] : null;
        $this->placa = !empty($data['placa']) ? $data['placa'] : null;
        $this->modelo = !empty($data['modelo']) ? $data['modelo'] : null;
        

    }

    public function getId() {
       return $this->id; 
    }

    public function setId($id) {
        $this->id = $id; 
    }

    public function getNome() {
        return $this->nome; 
     }
 
     public function setNome($nome) {
         $this->nome = $nome; 
     }

     public function getRg() {
        return $this->rg; 
     }
 
     public function setRg($rg) {
         $this->rg = $rg; 
     }

     public function getCpf() {
        return $this->cpf; 
     }
 
     public function setCpf($cpf) {
         $this->cpf = $cpf; 
     }

     public function getTelefone() {
        return $this->telefone; 
     }
 
     public function setTelefone($telefone) {
         $this->telefone = $telefone; 
     }

     public function getVeiculoId() {
        return $this->veiculo_id; 
     }
 
     public function setVeiculoId($veiculo_id) {
         $this->veiculo_id = $veiculo_id; 
     }

     public function getPlaca() {
        return $this->placa; 
     }
 
     public function setPlaca($placa) {
         $this->placa = $placa; 
     }

     public function getModelo() {
        return $this->modelo; 
     }
 
     public function setModelo($modelo) {
         $this->modelo = $modelo; 
     }

     public function getArrayCopy(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'rg' => $this->rg,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'veiculo_id' => $this->veiculo_id,
            'placa' => $this->placa,
            'modelo' => $this->modelo
        ];
     }
}