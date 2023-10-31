<?php 

namespace Veiculo\Model;

class Veiculo implements \Zend\Stdlib\ArraySerializableInterface{
    private $id;
    private $placa;
    private $renavam;
    private $modelo;
    private $marca;
    private $ano;
    private $cor;

    public function exchangeArray(array $data){

        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->placa = !empty($data['placa']) ? $data['placa'] : null;
        $this->renavam = !empty($data['renavam']) ? $data['renavam'] : null;
        $this->modelo = !empty($data['modelo']) ? $data['modelo'] : null;
        $this->marca = !empty($data['marca']) ? $data['marca'] : null;
        $this->ano = !empty($data['ano']) ? $data['ano'] : null;
        $this->cor = !empty($data['cor']) ? $data['cor'] : null;

    }

    public function getId() {
       return $this->id; 
    }

    public function setId($id) {
        $this->id = $id; 
    }

    public function getPlaca() {
        return $this->placa; 
     }
 
     public function setPlaca($placa) {
         $this->placa = $placa; 
     }

     public function getRenavam() {
        return $this->renavam; 
     }
 
     public function setRenavam($renavam) {
         $this->renavam = $renavam; 
     }

     public function getModelo() {
        return $this->modelo; 
     }
 
     public function setModelo($modelo) {
         $this->modelo = $modelo; 
     }

     public function getMarca() {
        return $this->marca; 
     }
 
     public function setMarca($marca) {
         $this->marca = $marca; 
     }

     public function getAno() {
        return $this->ano; 
     }
 
     public function setAno($ano) {
         $this->ano = $ano; 
     }

     public function getCor() {
        return $this->cor; 
     }
 
     public function setCor($cor) {
         $this->cor = $cor; 
     }

     public function getArrayCopy(): array {
        return [
            'id' => $this->id,
            'placa' => $this->placa,
            'renavam' => $this->renavam,
            'modelo' => $this->modelo,
            'marca' => $this->marca,
            'ano' => $this->ano,
            'cor' => $this->cor
        ];
     }
}