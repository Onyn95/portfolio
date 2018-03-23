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

  public function deletAction()
    {
      $id =$this->params()->fromQuery('id');
      //echo json_encode($id);
       unlink(ROOT_PATH."/public/img/upload/".$id.".png");
     $this->table->deletePhoto($id);
     
           
      
     exit();
         
    }
    public function editAction() {
       
          $id = (int) $this->params()->fromRoute('id', 0);
          
          
           try {
            $photo = $this->table->getPhoto($id);
        } catch (\Exception $e) {
            return $e;
        }
        
        $form = new \Album\Form\AddPhotoForm() ;  
      //  $form->bind($photo);
       // $form->get('submit')->setAttribute('value', 'Edit');
        // $form->bind($photo);
        $form->get('envoyer')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($photo->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }
    }

    public function searchAction() {
        
       
        $photo = $this->table->getNom($this->params()->fromQuery('term'));
       
        
       
        $datas = array();
        foreach ($photo as $key => $data ) {
            $datas[$key]['label'] = $data->titre;
            $datas[$key]['value'] = $data->id;
        }
       
       
        echo json_encode($datas);

       
        die();
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
    
   public function galeriephotoAction(){
        return new ViewModel([
            
            //'albums'=>$this->tableAlbum->fetchAll(),
              'admins'=>$this->table->fetchAll(),
          
        ]);
      
       
   } 

}