<?php
namespace Album\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

// A feedback form model
class AddPhotoForm extends Form
{
  // Constructor.   
  public function __construct($name=null)
  {
    // herite de zend form
    parent::__construct('addPhoto');
    $this->setAttribute('method', 'post');
    $this->setAttribute('enctype', 'multipart/form-data');
    
    //element du form
     $this->add([
      'type'  => 'text',        // Element type
      'name' => 'titre',      // Field name
      'attributes' => [         // Array of attributes
        'id'  => 'titre', 
          'class'=>'form-control',//class css
                                   
      ],
      'options' => [            // Array of options
         'label' => 'Titre de l\'image',
           // Text label
      ],
    ]);
    $this->add([
      'type'  => 'file',        // Element type
      'name' => 'file',      // Field name
      'attributes' => [         // Array of attributes
        'id'  => 'file', 
          'class'=>'form-control',//class css
                                   
      ],
      'options' => [            // Array of options
         'label' => 'Choisir une image',
           // Text label
      ],
    ]);
    
 

    
    $this->add([
      'type'  => 'select',        // Element type
      'name' => 'affichage',      // Field name
      'attributes' => [         // Array of attributes
        'id'  => 'affichage',
        'class'=>'form-control col-md-3',
        'value' =>'affichage',
        'style'=>'margin-top:25px;',
           
          
      ],
      'options'=>[
         'label'=>'Affichage de la photo',
          'empty_option' => 'Choix',
         'value_options' => [           
         '1' => 'Oui',
         '2' => 'Non', 
        ]
      ],
    
    ]);  
    
    
    $this->add([
      'type'  => 'submit',        // Element type
      'name' => 'envoyer',      // Field name
      'attributes' => [         // Array of attributes
        'id'  => 'envoyer',
        'class'=>'btn btn-primary',
        'value' =>'envoyer',
        'style'=>'margin-top:25px;'
      ],
    ]);  
    //ajout d'un validateur
       $this->addInputFilter();     
   
  }
  
   private function addInputFilter() 
    {
        $inputFilter = new InputFilter();   
        $this->setInputFilter($inputFilter);
     
        // Add validation rules for the "file" field.	 
        $inputFilter->add([
                'type'     => 'Zend\InputFilter\FileInput',
                'name'     => 'file',
                'required' => true,   
                'validators' => [
                    ['name'    => 'FileUploadFile'],
                    [
                        'name'    => 'FileMimeType',                        
                        'options' => [                            
                            'mimeType'  => ['image/jpeg', 'image/png','image/gif']
                        ]
                    ],
                    ['name'    => 'FileIsImage'],
                    [
                        'name'    => 'FileImageSize',
                        'options' => [
                            'minWidth'  => 10,
                            'minHeight' => 10,
                            'maxWidth'  => 4096,
                            'maxHeight' => 4096
                        ]
                    ],
                ],
                'filters'  => [                    
                    [
                        'name' => 'FileRenameUpload',
                        'options' => [  
                            'target'=>'./public/img/upload',
                            'useUploadName'=>true,
                            'useUploadExtension'=>true,
                            'overwrite'=>true,
                            'randomize'=>false
                        ]
                    ]
                ],   
            ]);                
    }
}