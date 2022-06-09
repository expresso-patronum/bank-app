<?php

namespace App\Models;
use CodeIgniter\Model;

class AccountModel extends Model {

    protected $table = 'conta';
    protected $primaryKey = 'numero';
    protected $allowedFields = ['numero', 'tipo', 'username', 'saldo'];

 
    public function getAccount($numero) {
        return $this->asArray()->where(['numero' => $numero])->first();
    }

    public function getSaldo($numero) {
        $db = db_connect();
        $builder = $db->table('conta');
        $builder->select('saldo');
        $builder->where('conta.numero', $numero);
        $query = $builder->get();
        $saldo = $query->getResultArray();

        return $saldo[0];
    }

    public function getCheckingAccount($cliente) {
        $db = db_connect();
        //return $this->asArray()->where(['usuario' => $usuario])->first();
        $builder = $db->table('conta');
        $builder->select('*');
        $builder->join('cliente', 'cliente.username = conta.username');
        $builder->where('conta.username', $cliente);
        $builder->where('conta.tipo', 'corrente');
        $query = $builder->get();
        $contas = $query->getResultArray();

        return $contas[0];

    }

    public function insertAccount($data) {            
        $insert = $this->insert($data);
        return $insert;
    }

    public function updateAccount($numero, $data)
    {
        return $this->update($numero, $data);
    }
    public function getSavingAccount($cliente){
        $db = db_connect();
        //return $this->asArray()->where(['usuario' => $usuario])->first();
        $builder = $db->table('conta');
        $builder->select('*');
        $builder->join('cliente', 'cliente.username = conta.username');
        $builder->where('conta.username', $cliente);
        $builder->where('conta.tipo', 'poupanca');
        $query = $builder->get();
        $contas = $query->getResultArray();

        return $contas[0];
    
    }


}

?>