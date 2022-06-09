<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extratos</title>
</head>
<body>
    <style>
        
    button{
        margin: auto;
        background-color: rgb(32,105,92);
        color: #FFFF;
        width: 20%;
        height: 60px;
        border: none;
        border-radius: 10px;
    }

    table {
        border-collapse:separate;
        border-spacing:0 15px;
        border: 1px solid black;
        margin: auto;
        margin-top: 5%;    
        background-color: #CCD3D3;
    }

    td {
        width:150px;
        text-align:center;
        border:none;
        padding:5px;
        
    }
    
    .info {
        margin: auto;
        width: 500px;
        height: 210px;
        text-align:justify;
    }

    .scroll {
        margin: auto;
        width: 500px;
        height: 210px;
        overflow: scroll;
        text-align:justify;
    }
    </style>

     <header>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <script>
            $(document).ready(function () {
                <?php if(session()->getFlashdata('messageRegisterOk')) { ?>
                    alertify.set('notifier','position', 'top-right');
                    alertify.success('Login feito com sucesso!');
                <?php } ?>
            })
        </script>
        
        <?= $this->renderSection('scripts') ?>
  
        <div class="info">
            <?php                   
              echo "<h5>Cliente: ".$cliente."</h5>";  
            echo "<h5>Número da conta: ".$contaCorrente."</h5>";
          
          
            ?>
        </div>
        <button>
    Logout
</button>
    </header>
    <h1>Extratos</h1>
            <div class="scroll">
                <?php
                foreach($transacoes as $transacao){
                    echo '<table>';
                    echo '<tr>';
                    echo '<td class="tipo">'.$transacao['metodoPagamento'].'</td>';
                    echo '<td>'.$transacao['descricao'].'</td>';
                    echo '<td>R$ '.$transacao['valor'].'</td>';
                    echo '<td>'.$transacao['datahora'].'</td>';
                    echo '</tr>';
                    echo '</table>';
                }
                ?>
           
            </div>
            <br><br>
</body>
</html>