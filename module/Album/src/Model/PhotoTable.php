<?php
namespace Album\Model;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
 
class PhotoTable {
     private $tableGateway;
     
    public function __construct(TableGatewayInterface $tableGateway)
    {
        
        $this->tableGateway = $tableGateway;
    } 
    
    public function fetchAll()
    {
        die("ok feee");
        return $this->tableGateway->select();
    }
     
}
