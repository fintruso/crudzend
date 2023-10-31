<?php

namespace Veiculo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Veiculo\Model\VeiculoTable;
use Veiculo\Form\VeiculoForm;

class VeiculoController extends AbstractActionController {

    private $table;

    public function __construct(VeiculoTable $table) {
        $this->table = $table;
    }

    public function indexAction() {
        return new ViewModel(['veiculos' => $this->table->getAll()]);
    }

    public function adicionarAction() {

        $form = new \Veiculo\Form\VeiculoForm();

        $form->get('submit')->setValue('Adicionar');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]); 
        }
        
        $veiculo = new \Veiculo\Model\Veiculo();

        $form->setData($request->getPost());

        if (!$form->isValid()){ 
            return new ViewModel(['form' => $form]); 
        }

        $veiculo->exchangeArray($form->getData());

        $this->table->salvarVeiculo($veiculo);

        return $this->redirect()->toRoute('veiculo');
    }

    public function editarAction() {

        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id ===0) {
            return $this->redirect()->toRoute('veiculo', ['action'=>'adicionar']);
        }

        try {
            $veiculo = $this->table->getVeiculo($id);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('veiculo', ['action'=>'index']);
        }

        $form = new VeiculoForm();

        $form->bind($veiculo);
        $form->get('submit')->setAttribute('value', 'Salvar');

        $request = $this->getRequest();

        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setData($request->getPost());

        if (!$form->isValid()){ 
            return $viewData;
        }

        $this->table->salvarVeiculo($form->getData());

        return $this->redirect()->toRoute('veiculo');

    }

    public function removerAction() {

        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id ===0) {
            return $this->redirect()->toRoute('veiculo', ['action'=>'adicionar']);
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == "Sim") {
                $id = (int) $request->getPost('id');
                $this->table->deletarVeiculo($id);
            }

            return $this->redirect()->toRoute('veiculo');
        }

        return ['id' => $id, 'veiculo' => $this->table->getVeiculo($id)];

    }

    public function confirmacaoAction() {
        return new ViewModel();
    }
}
