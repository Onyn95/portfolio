<?php
namespace Album\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author TSVQ9722
 * 
 */

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Auth {
    public $user;
    public $password;
    
    public function exchangeArray(array $data){
        
    
       $this->user = !empty($data['user']) ? $data['user'] : null;
       $this->password = !empty($data['password']) ? $data['password'] : null;
             
    }
    
    
}
