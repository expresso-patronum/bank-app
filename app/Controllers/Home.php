<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ClientsModel;
use App\Models\AccountModel;
use App\Models\AuditoriaModel;
use App\Models\TransactionsModel;

class Home extends BaseController
{
    public function index()
    {
        echo view('login');
    }

    public function cadastro()
    {
        echo view('cadastro');
    }

    
    public function cadastrar()
    {
        $clients_model = new ClientsModel();
        $account_model = new AccountModel();
        $transaction_model = new TransactionsModel();
        $custo = '08';
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';
        $senhaInic = $this->request->getVar('senha');
        
        $data = array(

            'username' => $this->request->getVar('username'),
            
            'nome' => $this->request->getVar('nome'),

            'senha' => crypt($senhaInic, '$2a$' . $custo . '$' . $salt . '$')
        );

        $data2 = array(
                
            'numero' => rand(100000000, 999999999),
            
            'tipo' => 'corrente',

            'username' => $this->request->getVar('username'),

            'saldo' => $this->request->getVar('saldo')
        );

        $data3 = array(
                
            'numero' => rand(100000000, 999999999),
            
            'tipo' => 'poupanca',

            'username' => $this->request->getVar('username')
        );
       

        $data4 = array(
    
            'tipo' => 'recebimento',

            'conta' => $data2['numero'],

            'valor' => $this->request->getVar('saldo'),
            
            'metodoPagamento' => 'dep. banc.',

            'descricao' => 'Recebimento por meio de dep. banc.'

        );

        $clients_model->insertClient($data);
        $account_model->insertAccount($data2);
        $account_model->insertAccount($data3);
        $transaction_model->insertTransaction($data4);
        session()->set(['username'=>$data['username']]);
        $session = session();
        
        return redirect()->to(base_url('/'));
        $session->setFlashdata("messageRegisterOk", "Registro feito com sucesso!");

        //$this->cadastrarProdutoToDB($product_model);
    
    }

    public function logar() {

        $clients_model = new ClientsModel();
        $auditoria_model = new AuditoriaModel();
        $data = array(
    
            'username' => $this->request->getVar('username'),
            
            'nome' => $this->request->getVar('nome'),

            'senha' => $this->request->getVar('senha')

        );

        $dataAuditoria = array(
    
            'username' => $this->request->getVar('username'),
            
            'tipo' => 'login'

        );
        
        $cliente = $clients_model->getClient($data['username']);
        $custo = '08';
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';

        if ($cliente['senha'] ==  crypt($data['senha'], '$2a$' . $custo . '$' . $salt . '$')) {
            session()->set(['username'=>$data['username']]);
           // session()->setFlashdata('messageRegisterOk','messageRegisterOk');
            //$this->session->setFlashdata('messageRegisterOk',' Registered Successfull. Please, login.' );
            $session = session();
            $session->setFlashdata("messageRegisterOk", "Login feito com sucesso");
          
            
            $auditoria_model->insertAuditoria($dataAuditoria);
        
           return redirect()->to(base_url('/pagInicial'));
        
        } else { 
            echo 'Senha inválida';
        }
        
    }

    public function deslogar($username) {
       $clients_model = new ClientsModel();
       $auditoria_model = new AuditoriaModel();
       $dataAuditoria = array(

           'username' => $username,
                
           'tipo' => 'logout'

       );
       $auditoria_model->insertAuditoria($dataAuditoria);
       session()->remove($username);
       return redirect()->to(base_url('/'));
    }

    public function pagInicial () {

        $username = session()->get();
        $account_model = new AccountModel();
        $result = $account_model->getCheckingAccount($username['username']);
        echo view ('pagInicial', ['contaCorrente'=> $result['numero'], 'cliente'=> $result['nome'], 'saldo'=> $result['saldo'], 'username'=>$username['username']]);
        
    }

    public function extratos () {

        $username = session()->get();
        $transaction_model = new TransactionsModel();
        $account_model = new AccountModel();
        $result1 = $transaction_model->getTransactions($username['username']);
        $result2 = $account_model->getCheckingAccount($username['username']);
        echo view ('extratos', ['transacoes'=> $result1, 'contaCorrente'=> $result2['numero'], 'cliente'=> $result2['nome'], 'saldo'=> $result2['saldo']]);//'username'=>$username, 'tipo'=>$result['tipo'], 'descricao'=>$result['descricao'], 'data'=>$result['datahora']]);
    }

    public function pagamentos() {
        echo view('pagamentos');
    }
    public function poupanca(){
        $username = session()->get();
        $transaction_model = new TransactionsModel();
        $account_model = new AccountModel();
        $result1 = $transaction_model->getTransactions($username['username']);
        $result2 = $account_model->getCheckingAccount($username['username']);
        $result3 = $account_model->getSavingAccount($username['username']);
        echo view('poupanca',['transacoes'=> $result1, 'contaCorrente'=> $result2['numero'], 'cliente'=> $result2['nome'], 'saldo'=> $result2['saldo'], 'saldoContaPoupanca'=> $result3['saldo']]);
    }

    public function aplicar(){
        
        $username = session()->get();
      
        $transaction_model = new TransactionsModel();
        $account_model = new AccountModel();
        
        $result = $account_model->getSavingAccount($username['username']); //poupanca
       //$result['conta'] É A NOSSA CONTA QUE RECEBE
       //$result2['conta'] É A NOSSA CONTA QUE PAGA
        $result2 = $account_model->getCheckingAccount($username['username']); //conta corrente

        $dataPag = array(
    
            'tipo' => 'aplicacao',

            'conta' => $result2['numero'],

            'valor' => $this->request->getVar('valor'),
            
            'metodoPagamento' => 'aplic. poup.',

            'descricao' => 'Pagamento por meio de aplic. na poup.'

        ); // colocar no banco o pagamento
        
        $dataReceb = array(
    
            'tipo' => 'recebimento',

            'conta' => $result['numero'],

            'valor' => $this->request->getVar('valor'),
            
            'metodoPagamento' => 'aplic. poup.',

            'descricao' => 'Recebimento por meio de aplic. na poup.'

        ); // colocar no banco o recebimento

        $saldoPoupanca = $account_model->getSaldo($result['numero']);
        $saldoCorrente = $account_model->getSaldo($result2['numero']);


        if($saldoCorrente['saldo'] >= 0 && $saldoCorrente['saldo'] > $dataPag['valor']) {
            
            $subtrai = (int)($saldoCorrente['saldo'] - $dataPag['valor']);

            $soma = (int)($saldoPoupanca['saldo'] + $dataReceb['valor']);

            $dataPoupanca = array(
                'saldo' => $soma
            );

            $dataCorrente = array(
                'saldo' => $subtrai
            );

            $transaction_model->insertTransaction($dataPag);
            $transaction_model->insertTransaction($dataReceb);
            $account_model->updateAccount($result['numero'], $dataPoupanca);
            $account_model->updateAccount($result2['numero'], $dataCorrente);
            return redirect()->to(base_url('/poupanca'));
        
        } else {

            session()->set($username);
            $session = session();
            $session->setFlashdata("messageAplicationError", "Erro ao realizar a aplicação");
            return redirect()->to(base_url('/poupanca'));
        }
    }

    public function resgatar() {
        
        $username = session()->get();
      
        $transaction_model = new TransactionsModel();
        $account_model = new AccountModel();
        
        $result = $account_model->getSavingAccount($username['username']); //poupanca
       //$result['conta'] É A NOSSA CONTA QUE RECEBE
       //$result2['conta'] É A NOSSA CONTA QUE PAGA
        $result2 = $account_model->getCheckingAccount($username['username']); //conta corrente

        $dataResg = array(
    
            'tipo' => 'resgate',

            'conta' => $result['numero'],

            'valor' => $this->request->getVar('valor'),
            
            'metodoPagamento' => 'resg. poup.',

            'descricao' => 'Resgate da conta poup.'

        ); // colocar no banco o pagamento
        
        $dataReceb = array(
    
            'tipo' => 'recebimento',

            'conta' => $result2['numero'],

            'valor' => $this->request->getVar('valor'),
            
            'metodoPagamento' => 'resg. poup.',

            'descricao' => 'Recebimento por resgate da conta poup.'

        ); // colocar no banco o recebimento

        $saldoPoupanca = $account_model->getSaldo($result['numero']);
        $saldoCorrente = $account_model->getSaldo($result2['numero']);


        if($saldoPoupanca['saldo'] >= 0 && $saldoPoupanca['saldo'] > $dataResg['valor']) {
            
            $subtrai = (int)($saldoPoupanca['saldo'] - $dataResg['valor']);

            $soma = (int)($saldoCorrente['saldo'] + $dataReceb['valor']);

            $dataPoupanca = array(
                'saldo' => $subtrai
            );

            $dataCorrente = array(
                'saldo' => $soma
            );

            $transaction_model->insertTransaction($dataResg);
            $transaction_model->insertTransaction($dataReceb);
            $account_model->updateAccount($result['numero'], $dataPoupanca);
            $account_model->updateAccount($result2['numero'], $dataCorrente);
            return redirect()->to(base_url('/poupanca'));
        
        } else {

            session()->set($username);
            $session = session();
            $session->setFlashdata("messageRedemptionError", "Erro ao realizar o resgate");
            return redirect()->to(base_url('/poupanca'));
        }
    }

    
    public function pagar() {
        $username = session()->get();
        $account_model = new AccountModel();
        $transaction_model = new TransactionsModel();
        $result = $account_model->getCheckingAccount($username['username']);
        $data = array(
    
            'tipo' => 'pagamento',

            'conta' => $result['numero'],

            'valor' => $this->request->getVar('valor'),
            
            'metodoPagamento' => $this->request->getVar('metodoPagamento'),

            'descricao' => 'Pagamento feito por '.$this->request->getVar('metodoPagamento'),

        );

        $saldo = $account_model->getSaldo($result['numero']);
        if($saldo['saldo'] >= 0 && $saldo['saldo'] > $data['valor']) {
            $subtrai = (int)($saldo['saldo'] - $data['valor']);

            $dataConta = array(
                'saldo' => $subtrai
            );

            $transaction_model->insertTransaction($data);
            $account_model->updateAccount($result['numero'], $dataConta);
            return redirect()->to(base_url('/pagInicial'));
        
        } else {

            session()->set($username);
            $session = session();
            $session->setFlashdata("messagePaymentError", "Erro ao realizar o pagamento");
            return redirect()->to(base_url('/pagamentos'));
        }
    }

    public function transferencia() {
        $username = session()->get();
        $transaction_model = new TransactionsModel();
        $account_model = new AccountModel();
        $result1 = $transaction_model->getTransactions($username['username']);
        $result2 = $account_model->getCheckingAccount($username['username']);
        echo view('transferencia',['transacoes'=> $result1, 'contaCorrente'=> $result2['numero'], 'cliente'=> $result2['nome'], 'saldo'=> $result2['saldo']]);
    
    }

    public function transferir() {
        $username = session()->get();
        $account_model = new AccountModel();
        $transaction_model = new TransactionsModel();
        $result = $account_model->getCheckingAccount($username['username']); // pessoa q ta pagando


        $data1 = array(
    
            'tipo' => 'transferencia',

            'conta' => $result['numero'],

            'valor' => $this->request->getVar('valor'),
            
            'metodoPagamento' => 'dep. banc.',

            'descricao' => 'Transferência feita por dep. banc.',

        );

        $data2 = array(
    
            'tipo' => 'transferencia',

            'conta' => $this->request->getVar('conta'),

            'valor' => $this->request->getVar('valor'),
            
            'metodoPagamento' => 'dep. banc.',

            'descricao' => 'Recebimento feito por dep. banc.',

        );

        $saldo = $account_model->getSaldo($result['numero']); // saldo da conta que ta enviando
        $saldoDestino = $account_model->getSaldo($data2['conta']); // saldo da conta destino

        if($saldo['saldo'] >= 0 && $saldo['saldo'] > $data1['valor']) {
            $subtrai = (int)($saldo['saldo'] - $data1['valor']);
            $soma = (int)($saldoDestino['saldo'] + $data2['valor']);

            $dataConta = array(
                'saldo' => $subtrai
            );

            $dataContaDestino = array(
                'saldo' => $soma
            );

            $transaction_model->insertTransaction($data1);
            $transaction_model->insertTransaction($data2);
            $account_model->updateAccount($result['numero'], $dataConta);
            $account_model->updateAccount($data2['conta'], $dataContaDestino);
            return redirect()->to(base_url('/transferencia'));
        
        } else {

            session()->set($username);
            $session = session();
            $session->setFlashdata("messageTransferError", "Erro ao realizar a transferência!");
            return redirect()->to(base_url('/transferencia'));
        }
    }
}
