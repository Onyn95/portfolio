<?php
namespace Album\Controller;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\ViewModel;
use Application\Auth\Adapter;
use Zend\Authentication\AuthenticationService;
use Zend\Session\Container;
use Zend\Authentication\Storage\Session;
use Album\Model\AuthTable;
use Album\Model\Photo;


class AuthController extends AbstractActionController{
    
    protected $form;
    protected $storage;
    protected $authservice;   
    protected $auth;
    protected $authAdapter;
    private $table;


    public function __construct(AuthTable $table){
      
        $this->table = $table;
        
    }
  
    public function onDispatch(MvcEvent $e) {
      $response =  parent::onDispatch($e);
       $this->layout()->setTemplate('layout/layout2');
       return $response;
    }
    
    
    public function indexAction(){
  // initialisation de l'objet form
        
       
   $form = new \Album\Form\AuthForm() ;
  
   
   //return un tableau form
      return array('form'=>$form);
   }
    
   public function getSessionStorageAction(){
    
      //die("ok");
      //d($this->tableGateway);
     
        $values=($this->params()->fromPost());
        $this->storage = new Session();    
        $this->authAdapter = new Adapter($this->table,$values['identifiant'],$values['mdp']);
        $this->authservice = new AuthenticationService($this->storage, $this->authAdapter);        
        $result =  $this->authservice->authenticate();
      
        switch($result->getCode()){
            case 0: 
                
                    $message= 'mdp faux';
                   $this->redirect()->toRoute(
    'auth', 
    array(
        'action' => 'index',
        'message'=>"fail_mdp"
    ));
     
                break;
            case 1:
              ;
                $message= 'mdp ok';
                
                /****
                   $this->redirect()->toRoute(
    'auth', 
    array(
        'action' => 'admin',
        'message'=>"Bienvenue"
    ));*/
                
                           $this->redirect()->toRoute(
    'admin', 
    array(
        'action' => 'index',
        'message'=>"Bienvenue"
    ));
            
            default: $message='';
                
                break;
            
        }
       
   }
   
    public function adminAction(){
        $storage = new Session();
        
        if ($storage -> read() == null){
            
            $message= 'Redirection';
                   $this->redirect()->toRoute(
                   'auth', 
                  array(
                         'action' => 'index',
                         'message'=>""
                  ));
            
        }
          
        $form = new \Album\Form\AddPhotoForm() ;  
        
        //on regarde si l'utilisateur a bien envoyer le formulaire
        if($this->getRequest()->isPost()){
            $request = $this->getRequest();
            $data = array_merge_recursive(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()  
                    );
                    
            $form->setData($data);
            
             // Execute file validators.
            if($form->isValid()) {
                
                // Execute file filters.
                $data = $form->getData();
                $photo = new Photo();
                $photo->savePhoto($data);
                $this->redirect()->toRoute(
                   'auth', 
                  array(
                         'action' => 'galerie',
                         'message'=>""
                  ));
              
                 
        }
        
        }
        //return un tableau form
        return array('form'=>$form);
   
        
        
    }
    
    public function galerieAction(){
        
        
        
    }
   
  /*  
  $storage = new Session();
         $authAdapter = new Adapter("Alan", "jsuispd");
         $auth = new AuthenticationService($storage, $authAdapter);

         $result = $auth->authenticate();
         
         
      
        d($storage->read());
        die();
   * */
  
}
