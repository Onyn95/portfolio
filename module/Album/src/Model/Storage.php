<?php
namespace Album\Model;
//creation d'un storage pour la session 
use Zend\Authentication\Storage;

// on étends la fonction avec la session storage qui se trouve dans Zend\Authentication\Storage
class Storage extends Storage\Session {
    
 //création de la fonction qui va stocker les identifiants pour rester connecter
    
  public function setRememberMe($rememberMe = 0, $time = 1209600){
      
     if ($remberMe ==1){
         
         $this->session->getManager()->rememberMe($time);
     } 
   }    
  public function forgetMe(){
      
      $this->session->getManager()->forgetMe();
  }    
      
      
  
    
    
}
