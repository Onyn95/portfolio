<?php
namespace Album\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class AuthTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

     public function fetchAll()
    {
         
        
        return $this->tableGateway->select();
    }
    
    public function getTableGateway(){
        return $this->tableGateway;
    }
    
    
}    