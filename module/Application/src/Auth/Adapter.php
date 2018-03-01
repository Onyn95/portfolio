<?php
namespace Application\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Db\Adapter\Adapter as AdapterDB;
use Zend\Db\Sql\Sql;

class Adapter implements AdapterInterface
{
    
    private $username;
    private $password;
    private $db;
    /**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($db,$username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db= $db;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *     If authentication cannot be performed
     */
    public function authenticate()
    {
        // ...
        //(AdapterInterface $adapter, $table = null, Platform\AbstractPlatform $sqlPlatform = null)
      //  d($adapter = new AdapterDB($configArray));
   
        $sql =new Sql($this->db->getTableGateway()->getAdapter());
        $table ="user"; 
      
        $where = array('username'=>$this->username, 'password'=>$this->password);
        $requete = $sql->select()
               ->from($table)->where($where)
               ;
       $statement = $sql->prepareStatementForSqlObject($requete);
       $result= $statement->execute()->current();
      
    
    
         
     
       
  //  $this->db->getTableGateway()->getAdapter()->query($requete)->execute();
      if ($result == true){
          $result = new Result(1, array('user'=>$this->username, 'password'=>$this->password));
         // echo "connecion etablie";
          
        //  return $result;
      }else{
          $result = new Result(0, array('user'=>$this->username, 'password'=>$this->password));
          //echo "Bad Credential";
          
      }
      
       
      // echo $result->isValid();
      
     //  $result->isValid();
       
      
       return $result;
       
    }
}