<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Domingo Massa</title>
    </head>

    <body>
        <h1>Ingressos Domingo Massa</h1>
        <h2>Escolha o número de ingressos desejado:</h2>
        <form id="main_form">
            <section id="error"></section>
            <section id="items"></section>
            <section>
                <p><button type="submit">Comprar</button></p>
            </section>
        </form>
    </body>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<?php if (getenv('PAGSEGURO_ENV') === 'test') { ?>
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
<?php } else { ?>
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
<?php } ?>
    <script type="text/javascript" src="js/app.js"></script>
</html>
