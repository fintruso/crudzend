<?php 

namespace Motorista\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class MotoristaForm extends Form
{
    public function __construct($veiculos = [], $selectedVeiculo = null)
    {
        parent::__construct('motorista', []);

        $this->add(new Element\Hidden('id'));

        $nome = new Element\Text('nome');
        $nome->setLabel('Nome');
        $nome->setAttributes(['maxlength' => '200']);
        $this->add($nome);

        $rg = new Element\Text('rg');
        $rg->setLabel('Rg');
        $rg->setAttributes(['maxlength' => '20']);
        $this->add($rg);

        $cpf = new Element\Text('cpf');
        $cpf->setLabel('Cpf');
        $cpf->setAttributes(['maxlength' => '11']);
        $this->add($cpf);

        $telefone = new Element\Text('telefone');
        $telefone->setLabel('Telefone');
        $telefone->setAttributes(['maxlength' => '20']);
        $this->add($telefone);

        $veiculoSelect = new Element\Select('veiculo_id');
        $veiculoSelect->setLabel('Veículo');
        $veiculoSelect->setValueOptions($veiculos);
        $veiculoSelect->setValue($selectedVeiculo);
        $this->add($veiculoSelect);

        $submit = new Element\Submit('submit');
        $submit->setAttributes(['value' => 'Salvar', 'id' => 'submitbutton']);
        $this->add($submit);

        // Configurar validações usando um InputFilter
        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'nome',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Nome é obrigatório.'
                        ],
                    ],
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 200,
                        'messages' => [
                            StringLength::TOO_LONG => 'Nome deve ter no máximo 200 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'rg',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'RG é obrigatório.'
                        ],
                    ],
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 20,
                        'messages' => [
                            StringLength::TOO_LONG => 'RG deve ter no máximo 20 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'cpf',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'CPF é obrigatório.'
                        ],
                    ],
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 11,
                        'messages' => [
                            StringLength::TOO_LONG => 'CPF deve ter no máximo 11 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'telefone',
            'required' => false,
            'filters' => [],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 20,
                        'messages' => [
                            StringLength::TOO_LONG => 'Telefone deve ter no máximo 20 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $this->setInputFilter($inputFilter);
    }
}

?>