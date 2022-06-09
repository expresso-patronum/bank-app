<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferência</title>
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
                <?php if(session()->getFlashdata("messageTransferError")) { ?>
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('Erro ao realizar a transferência!');
                <?php } ?>
            })
        </script>
    </header>

    <div class="info">
        <?php                     
            echo "<h5>Número da conta: ".$contaCorrente."</h5>";
            echo "<h5>Cliente: ".$cliente."</h5>";
            echo "<h5>Saldo da conta corrente: R$ ".$saldo."</h5>";
        ?>
    </div>
    

    <form method='post' action= '/transferir'>
        <input type="number" name="conta" id="conta" placeholder="Conta destino">
        <input type='number' id='valor' name='valor' placeholder="Insira aqui a quantia "/>
        <button type="submit">Transferir </button>
    </form>

</body>
</html>