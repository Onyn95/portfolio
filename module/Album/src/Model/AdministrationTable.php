<?php
namespace Album\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;


class AdministrationTable {
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
     
        $this->tableGateway = $tableGateway;
    }
    
    

    public function fetchAll()
    {
      
        return $this->tableGateway->select();
    }
    
    public function deletePhoto($id)
           
    {
       
        $this->tableGateway->delete(['id' => (int) $id]);
    }
    
   public function savePhoto(Administration $photo){
       
       
       $data = ['titre'=> $photo->titre, 'affichage'=>$photo->affichage];
       
       

        
            $this->tableGateway->insert($data);
           
         
            
            return $this->tableGateway->getLastInsertValue();
       

    
        

    }
    
    public function getNom($nom){
       
      /*  
        $select = new Select;
        $select->columns(array('label'=>'titre'))
                ->where(array('titre'=>$nom));
      
        $stmt = $select->prepareStatementForSqlObject($select);
        $stmt->execute(); 

        s($stmt);
        die();
       */
       
         $where = new \Zend\Db\Sql\Where();
         $where ->like('titre','%'.$nom.'%');
     
      $rowset = $this->tableGateway->select($where);
      
     
       
       if (! $rowset) {
            throw new RuntimeException(sprintf(
                'Pas d\'identification',
                $nom
            ));
        }
     
        return $rowset;
       
        
    }
    
    
     public function getPhoto($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Pas d\'identification',
                $id
            ));
        }

        return $row;
    }
  public function editPhoto(Administration $photo){
      
      
      
  }  
       
   } 

