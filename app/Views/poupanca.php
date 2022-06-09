<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poupança</title>
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
                <?php if(session()->getFlashdata("messageAplicationError")) { ?>
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('Erro ao realizar a aplicação!');
                <?php } ?>

                <?php if(session()->getFlashdata("messageRedemptionError")) { ?>
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('Erro ao realizar o resgate!');
                <?php } ?>
            })
        </script>
    </header>

    <div class="info">
        <?php                     
            echo "<h5>Número da conta: ".$contaCorrente."</h5>";
            echo "<h5>Cliente: ".$cliente."</h5>";
            echo "<h5>Saldo da conta corrente: R$ ".$saldo."</h5>";
            echo "<h5>Saldo da conta poupança: R$ ".$saldoContaPoupanca."</h5>";
        ?>
    </div>
    
    <div>
        
    </div>

    <form method='post' action= '/aplicar'>
        <input type='number' id='valor' name='valor' placeholder="Insira aqui a quantia "/>
        <button type="submit">Aplicar </button>
    </form>

    <form method='post' action= '/resgatar'>
            <input type='number' id='valor' name='valor' placeholder="Insira aqui a quantia"/>
            <button type="submit">Resgatar</button>
    </form>
</body>
</html>