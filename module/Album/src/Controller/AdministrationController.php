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
use Album\Model\AdministrationTable;
use Album\Model\Photo;
use Album\Model\Administration;

class AdministrationController extends AbstractActionController{
    
    protected $form;
    protected $storage;
    protected $authservice;   
    protected $auth;
    protected $authAdapter;
    private $table;
   
    public function __construct(AdministrationTable $table){
 
        $this->table = $table;
        
    }

  
    public function onDispatch(MvcEvent $e) {
      $response =  parent::onDispatch($e);
       $this->layout()->setTemplate('layout/layoutAdmin');
       return $response;
    }
    
    public function indexAction() {
       
   
    
}


public function addphotoAction(){
    
        // $album->exchangeArray($form->getData());
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
                $photo = new \Album\Model\Administration();
                $photo->exchangeArray($data);
                $id = $this->table->savePhoto($photo);
               
                rename($data['file']['tmp_name'],ROOT_PATH."/public/img/upload/".$id.".png");
                //$data['file']['tmp_name'] = $id.".png";
               
                /*
                $this->redirect()->toRoute(
                   'auth', 
                  array(
                         'action' => 'galerie',
                         'message'=>""
                  ));
              */
                 
        }
        
        }
        //return un tableau form
        return array('form'=>$form);
   
        
    }

}