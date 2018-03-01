<?php
namespace Album\Form;

// Define an alias for the class name
use Zend\Form\Form;

// A feedback form model
class AuthForm extends Form
{
  // Constructor.   
  public function __construct($name=null)
  {
    // herite de zend form
    parent::__construct('login');  
    
    //element du form
    $this->add([
      'type'  => 'text',        // Element type
      'name' => 'identifiant',      // Field name
      'attributes' => [         // Array of attributes
        'id'  => 'identifiant', 
          'class'=>'form-control',//class css
                                   
      ],
      'options' => [            // Array of options
         'label' => 'identifiant',
           // Text label
      ],
    ]);   
    
     $this->add([
      'type'  => 'password',        // Element type
      'name' => 'mdp',      // Field name
      
      'attributes' => [         // Array of attributes
      'id'  => 'mdp',
          'class'=>'form-control',
          'required'=>'required'
          
          
      ],
      'options' => [            // Array of options
         'label' => 'Mot de passe',  // Text label
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
  }
}