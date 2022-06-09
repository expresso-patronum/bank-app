<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamentos</title>
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
                <?php if(session()->getFlashdata("messagePaymentError")) { ?>
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('Erro ao realizar o pagamento!');
                <?php } ?>
            })
        </script>
    </header>
    
    <?= $this->renderSection('scripts') ?>

    <form action="/pagar" method="post">
        <select name="metodoPagamento" id="metodoPagamento">
            <option value="PIX">PIX</option>
            <option value="boleto">Boleto</option>
            <option value="debito">Cartão de Crédito (Débito)</option>
            <option value="credito">Cartão de Crédito (Crédito)</option>
        </select>
        <input type="number" placeholder="Valor" name="valor" id="valor"/>
        <!-- <input type="text" placeholder="Descrição" name="descricao" id="descricao"/> -->
        <button type="submit">Realizar Pagamento</button>
    </form>
</body>
</html>