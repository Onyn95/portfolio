<?php
namespace Album\Model;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administartion
 *
 * @author TSVQ9722
 */
class Administration {
     public $chemin;
    public $titre;
    public $affichage;
    public $id;
    
  public function exchangeArray(array $data)
    {
      
       // $this->chemin     = !empty($data['file']['tmp_name']) ? $data['file']['tmp_name'] : null;
        $this->titre      =!empty($data['titre']) ?$data['titre']: null;
        $this->affichage  =!empty($data['affichage']) ?$data['affichage'] :null;
        $this->id  =!empty($data['id']) ?$data['id'] :null;
      //  $this->chemin = !empty($data['file']['tmp_name'])?$data['file']['tmp_name']: (!empty($data['chemin']) ? $data['chemin'] :null);
        
        }
    
    public function getArrayCopy()
    {
        die("ok");
        return [
            'chemin'     => $this->chemin,
            'titre' => $this->artist,
            'affichage'  => $this->title,
        ];
    }
    
}
