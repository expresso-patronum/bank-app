<?php

namespace App\Models;
use CodeIgniter\Model;

class ClientsModel extends Model {

    protected $table = 'cliente';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'nome', 'senha'];

 
    public function getClient($username) {
        return $this->asArray()->where(['username' => $username])->first();
    }

    public function insertClient($data) {            
        $insert = $this->insert($data);
        return $insert;
    }


}

class AuditoriaModel extends Model {

    protected $table = 'auditoria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'tipo', 'datahora'];

    public function insertAuditoria($data) {            
        $insert = $this->insert($data);
        return $insert;
    }
}

?>