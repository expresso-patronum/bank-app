<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <style>
        #logo {
            width: 9%;
            margin: 0;
            
        }
        .info {
         background-color: white;   
         display: flex;
        flex-direction: column;
        }

        button{
            background-color:#5B8882;
            border:none;
            width: 20%;
            height: 30%;
        }
    div{
        background-color: #B4E4D9;
        color: black;
        width: 40%;
        height: 40%;
    } 

    #links{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin-left: 10%;
        margin-right:10%;
        justify-content: space-around;
        align-items: center;
        
    }
    header{
        display: flex;
        flex-direction: row;
        
    }
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>
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
            echo "<h5>Número da conta: ".$contaCorrente."</h5>";
            echo "<h5>Cliente: ".$cliente."</h5>";
            echo "<h5>Saldo: R$ ".$saldo."</h5>";
            ?>
        </div>
      
            <?php
            echo "<form action='/deslogar/".$username."' method='post'> <button type='submit'>Logout</button></form>";
            ?>

    </header>

<div id='links'>
<div class='link'>
<a href='/extratos'>Extratos</a>
</div>
<div class='link'>
<a href='/poupanca'>Poupança</a>
</div>
<div class='link'>
<a href='/pagamentos'>Pagamentos</a>
</div>
<div class='link'>
<a href='/transferencia'>Tranferência</a>
</div>
    </div>

</body>
</html>