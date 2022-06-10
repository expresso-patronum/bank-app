<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap');

* {
    font-family: 'Inter', sans-serif;
}
        #logo {
            width: 6%;
            text-decoration: none;
            
        }
        .info {
         background-color: white;   
         display: flex;
        flex-direction: column;
        }

        button{
            margin: auto;
        background-color: rgb(32,105,92);
        color: #FFFF;
        width: 15%;
        height: 30px;
        border: none;
        border-radius: 10px;
        }


    #links{
        display: flex;
        flex-direction: row;
   flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        text-align: center;
        vertical-align: middle;
    }
    header{
        display: flex;
        flex-direction: row;
        
    }


.link{
    background-color:#B4E4D9;
   
        width: 30%;
        height: 80px;
margin-top: 5%;
       margin-left: 2%;
       margin-right: 2%;
       text-align: center;     
     line-height: 80px;

        
}
a{
    margin-top: 70%;
}

    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>
    <header>
    <img src="logo.png" id="logo"/>
        <script src="//maxcdn.bootstrapcfdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
  
      <header>
        <div class="info">
            <?php                   
                echo "<h5>Cliente: ".$cliente."</h5>";  
                echo "<h5>Número da conta: ".$contaCorrente."</h5>";
                echo "<h5>Saldo: R$ ".$saldo."</h5>";
            ?>
        </div>
      
            <?php
            echo "<form action='/deslogar/".$username."' method='post'> <button type='submit'>Logout</button></form>";
            ?>

    </header>

<div id='links'>
<div class='link'>
<a href='/extratos' style="text-decoration: none; color: black;  ">Extratos</a>
</div>
<div class='link'>
<a href='/poupanca' style="text-decoration: none; color: black;">Poupança</a>
</div>
<div class='link'>
<a href='/pagamentos' style="text-decoration: none; color: black; ">Pagamentos</a>
</div>
<div class='link'>
<a href='/transferencia' style="text-decoration: none; color: black;">Transferência</a>
</div> 

   
        </div>

        
</body>
</html>