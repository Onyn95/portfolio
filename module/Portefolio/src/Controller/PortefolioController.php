<?php
namespace Portefolio\Controller;

use Portefolio\Model\PortefolioTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Portefolio\Form\PortefolioForm;
use Portefolio\Model\Portefolio;

class PortefolioController extends AbstractActionController
{
    
    private $table;
    
    
    public function __construct(PortefolioTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
         return new ViewModel([
            'Portefolios' => $this->table->fetchAll(),
        ]);
    }

    
}
