<?php 

namespace Veiculo\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;

class VeiculoForm extends Form
{
    public function __construct()
    {
        parent::__construct('veiculo', []);

        $this->add(new Element\Hidden('id'));

        $placa = new Element\Text('placa');
        $placa->setLabel('Placa');
        $placa->setAttributes(['maxlength' => '7']);

        $this->add($placa);

        $renavam = new Element\Text('renavam');
        $renavam->setLabel('Renavam');
        $renavam->setAttributes(['maxlength' => '30']);

        $this->add($renavam);

        $modelo = new Element\Text('modelo');
        $modelo->setLabel('Modelo');
        $modelo->setAttributes(['maxlength' => '20']);

        $this->add($modelo);

        $marca = new Element\Text('marca');
        $marca->setLabel('Marca');
        $marca->setAttributes(['maxlength' => '20']);
        $this->add($marca);

        $ano = new Element\Number('ano');
        $ano->setLabel('Ano');
        $this->add($ano);

        $cor = new Element\Text('cor');
        $cor->setLabel('Cor');
        $this->add($cor);

        $submit = new Element\Submit('submit');
        $submit->setAttributes(['value' => 'Salvar', 'id' => 'submitbutton']);
        $this->add($submit);

        // Configurar validações usando um InputFilter
        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'placa',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Placa é obrigatória.'
                        ],
                    ],
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 7,
                        'messages' => [
                            StringLength::TOO_LONG => 'Placa deve ter no máximo 7 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'renavam',
            'required' => false,
            'filters' => [],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 30,
                        'messages' => [
                            StringLength::TOO_LONG => 'Renavam deve ter no máximo 30 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'modelo',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Modelo é obrigatório.'
                        ],
                    ],
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 20,
                        'messages' => [
                            StringLength::TOO_LONG => 'Modelo deve ter no máximo 20 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'marca',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Marca é obrigatória.'
                        ],
                    ],
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 20,
                        'messages' => [
                            StringLength::TOO_LONG => 'Marca deve ter no máximo 20 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'ano',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => Digits::class,
                    'options' => [
                        'messages' => [
                            Digits::NOT_DIGITS => 'Ano deve ser um número inteiro.'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'cor',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Cor é obrigatória.'
                        ],
                    ],
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 20,
                        'messages' => [
                            StringLength::TOO_LONG => 'Cor deve ter no máximo 20 caracteres.'
                        ],
                    ],
                ],
            ],
        ]);

        $this->setInputFilter($inputFilter);
    }
}
?>