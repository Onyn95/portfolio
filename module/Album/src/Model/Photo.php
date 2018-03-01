<?php
namespace Album\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
class Photo {
    public $chemin;
    public $titre;
    public $affichage;
    
     public function exchangeArray(array $data)
    {
      
  // s($data);
          
        $this->chemin     = !empty($data['file']['tmp_name']) ? $data['file']['tmp_name'] : null;
        $this->titre      =!empty($data['titre']) ?$data['titre']: null;
        $this->affichage  =!empty($data['affichage']) ?$data['affichage'] :null;
        
    }
    
    
    
   
}
