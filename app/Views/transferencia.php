<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferência</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

<style>

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap');

* {
    font-family: 'Inter', sans-serif;
    font-size: 1.0em;
}
#formTransferencia{
    margin: auto;
    height: 200px;
 
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; 
}

select, input{
    margin-top: 3%;
    background-color:#B4E4D9; 
    border:none;
    padding: 5px
}
#logo {
            width: 10%;
            text-decoration: none;
            
        }

button{
  
     margin-top:2%;
        background-color: rgb(32,105,92);
        color: white;
        width: 15%;
        height: 30px;
        border: none;
        border-radius: 10px;
}

    </style>
</head>
<body>

    <header>
    <img src="logo.png" id="logo"/>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <script>
            $(document).ready(function () {
                <?php if(session()->getFlashdata("messageTransferError")) { ?>
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('Erro ao realizar a transferência!');
                <?php } ?>
            })
        </script>
    </header>

    <div class="info">
        <?php                     
            echo "<h5>Cliente: ".$cliente."</h5>";
            echo "<h5>Número da conta: ".$contaCorrente."</h5>";
            echo "<h5>Saldo: R$ ".$saldo."</h5>";
        ?>
    </div>

    <?php
        echo "<form action='/deslogar/".$username['username']."' method='post'> <button type='submit'>Logout</button></form>";
    ?>
    

    <form method='post' action= '/transferir' id='formTransferencia'>
        <input type="number" name="conta" id="conta" placeholder="Conta destino">
        <input type='number' id='valor' name='valor' placeholder="Insira aqui a quantia "/>
        <button type="submit">Transferir </button>
    </form>

</body>
</html>