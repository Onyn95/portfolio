<?php
namespace Portefolio\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class PortefolioTable
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

    public function getPortefolio($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function savePortefolio(Portefolio $Portefolio)
    {
        $data = [
            'artist' => $Portefolio->artist,
            'title'  => $Portefolio->title,
        ];

        $id = (int) $Portefolio->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getPortefolio($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update Portefolio with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deletePortefolio($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}

