<?php

namespace App\Models;
use CodeIgniter\Model;

class TransactionsModel extends Model {

    protected $table = 'transacao';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tipo', 'valor', 'conta', 'metodoPagamento', 'descricao', 'datahora'];

 
    public function getTransactions($username){
        $db = db_connect();
        $builder = $db->table('transacao');
        $builder->select('*');
        $builder->join('conta', 'conta.numero = transacao.conta');
        $builder->where('conta.username', $username);
        $query = $builder->get();
        $conta = $query->getResultArray();
       
        return $conta;
    }

    public function getTransactionPerID($id = null){
        if ($id == null){
            return $this->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }

    public function insertTransaction($data) {            
        $insert = $this->insert($data);
        return $insert;
    }


}

?>