<?php

namespace Motorista\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Motorista\Model\MotoristaTable;
use Motorista\Model\VeiculoTable;
use Motorista\Form\MotoristaForm;

class MotoristaController extends AbstractActionController {

    private $table;
    private $veiculoTable;

    public function __construct(MotoristaTable $table, VeiculoTable $veiculoTable) {
        $this->table = $table;
        $this->veiculoTable = $veiculoTable;
    }

    public function indexAction() {
        
        return new ViewModel(['motoristas' => $this->table->getAll()]);
    }

    public function adicionarAction() {
        $form = new \Motorista\Form\MotoristaForm($this->veiculoTable->getVeiculosAsArray());
    
        $form->get('submit')->setValue('Adicionar');
    
        $request = $this->getRequest();
    
        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]); 
        }
    
        // Verifique se o formulário foi submetido e é válido
        $form->setData($request->getPost());
    
        if (!$form->isValid()) { 
            return new ViewModel(['form' => $form]); 
        }
    
        // Obtenha o ID do veículo selecionado a partir dos dados do formulário
        $selectedVeiculoId = $form->getData()['veiculo_id'];
        
        $motorista = new \Motorista\Model\Motorista();
        $motorista->exchangeArray($form->getData());
    
        // Salve o motorista no banco de dados, incluindo o ID do veículo
        $this->table->salvarMotorista($motorista);
    
        return $this->redirect()->toRoute('motorista');
    }

    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
    
        if ($id === 0) {
            return $this->redirect()->toRoute('motorista', ['action' => 'adicionar']);
        }
    
        try {
            $motorista = $this->table->getMotorista($id);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('motorista', ['action' => 'index']);
        }
    
        // lista de veículos
        $veiculos = $this->veiculoTable->getVeiculosAsArray();
    
        // Crie o formulário
        $form = new MotoristaForm($veiculos);
    
        // Obtem veículo do motorista sendo editado
        $veiculoIdDoMotorista = $motorista->getVeiculoId();
    
        //  veículo selecionado no campo de seleção
        $form->get('veiculo_id')->setValue($veiculoIdDoMotorista);
    
        $form->bind($motorista);
        $form->get('submit')->setAttribute('value', 'Salvar');
    
        $request = $this->getRequest();
    
        $viewData = ['id' => $id, 'form' => $form];
    
        if (!$request->isPost()) {
            return $viewData;
        }
    
        $form->setData($request->getPost());
    
        if (!$form->isValid()) {
            return $viewData;
        }
    
        // Salva o motorista com os novos dados
        $this->table->salvarMotorista($form->getData());
    
        return $this->redirect()->toRoute('motorista');
    }

    public function removerAction() {

        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id ===0) {
            return $this->redirect()->toRoute('motorista', ['action'=>'adicionar']);
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == "Sim") {
                $id = (int) $request->getPost('id');
                $this->table->deletarMotorista($id);
            }

            return $this->redirect()->toRoute('motorista');
        }

        return ['id' => $id, 'motorista' => $this->table->getMotorista($id)];

    }

    public function mapsAction() {

        $baseLat = -23.550520;
        $baseLng = -46.633308;

        $variation =    0.100;

        $motoristas = $this->table->getMotoristaTeste();

        $veiculos = [];

        foreach ($motoristas as $motorista) {

            $lat = $baseLat + (mt_rand(0, 200) / 1000) * $variation;
            $lng = $baseLng + (mt_rand(0, 200) / 1000) * $variation;

            $veiculos[] = [
                'position' => ['lat' => $lat, 'lng' => $lng],
                'title' => 'Veículo modelo: '. $motorista->getModelo(),
                'content' => 'Placa: '.$motorista->getPlaca().' | Motorista: '.$motorista->getNome().''
            ];
        }
        
        $veiculosJson = json_encode($veiculos, true);

        return new ViewModel(['veiculosJson' => $veiculosJson]);

    }

}
