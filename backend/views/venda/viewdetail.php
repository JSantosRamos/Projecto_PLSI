<?php
$desconto = $veiculo->price - $venda->Price;
?>

<div id="invoiceholder">

    <div id="headerimage"></div>
    <div id="invoice" class="effect2">

        <div id="invoice-top">
            <div class="clientlogo"></div>
            <div class="info">
                <h2>Vendedor:</h2>
                <p> <?= $vendedor->name;?><br>
                    <?= $vendedor->email;?><br><br> Telefone: <?= $vendedor->number;?>
                </p>
            </div><!--End Info-->
            <div class="title">
                <h1>Venda: #<?= $venda->id ?></h1>
            </div><!--End Title-->
        </div><!--End InvoiceTop-->

        <div id="invoice-mid">

            <div class="clientlogo"></div>
            <div class="info">
                <h2>Cliente:</h2>
                <p> <?= $cliente->name;?><br>
                    <?= $cliente->email;?><br><br> Telefone: <?= $cliente->number;?> | Nif: <?= $cliente->nif;?>
                </p>
            </div>
        </div><!--End Invoice Mid-->

        <div id="invoice-bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="Rate"><h2>ID</h2></td>
                        <td class="item"><h2>Descrição</h2></td>
                        <td class="Rate"><h2>Valor</h2></td>
                        <td class="subtotal"><h2>Valor venda</h2></td>
                        <td class="subtotal"><h2>Desconto</h2></td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem"><p class="itemtext"><?= $veiculo->id;?></p></td>
                        <td class="tableitem"><p class="itemtext"><?php echo $veiculo->brand .' ' .$veiculo->model . '('. $veiculo->plate .')';?></p></td>
                        <td class="tableitem"><p class="itemtext"><?= $veiculo->price?>€</p></td>
                        <td class="tableitem"><p class="itemtext"><?= $venda->Price ?>€</p></td>
                        <td class="tableitem"><p class="itemtext"><?= $desconto ?>€</p></td>
                    </tr>

                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="payment"><h2>Total: <?=$venda->Price ?>€</h2></td>
                    </tr>
                </table>
            </div><!--End Table-->

            <br>
            <h7>Detalhe do Veículo:</h7>
            <div class="bl_horizTable">
                <table>
                    <tbody>
                    <tr>
                        <th>Matrícula:</th>
                        <td><?= $veiculo->plate?></td>
                    </tr>
                    <tr>
                        <th>Marca:</th>
                        <td><?= $veiculo->brand?></td>
                    </tr>
                    <tr>
                        <th>Modelo:</th>
                        <td><?= $veiculo->model?></td>
                    </tr>
                    <tr>
                        <th>Serie:</th>
                        <td><?= $veiculo->serie?></td>
                    </tr>
                    <tr>
                        <th>Tipologia:</th>
                        <td><?= $veiculo->type?></td>
                    </tr>
                    <tr>
                        <th>Combustível:</th>
                        <td><?= $veiculo->fuel?></td>
                    </tr>
                    <tr>
                        <th>Quilómetro:</th>
                        <td><?= $veiculo->mileage?> km</td>
                    </tr>
                    <tr>
                        <th>Ano:</th>
                        <td><?= $veiculo->year?></td>
                    </tr>
                    <tr>
                        <th>Cilindrada:</th>
                        <td><?= $veiculo->engine?> cm3</td>
                    </tr>
                    <tr>
                        <th>Caixa:</th>
                        <td><?= $veiculo->transmission?></td>
                    </tr>
                    <tr>
                        <th>NºPortas:</th>
                        <td><?= $veiculo->doorNumber?></td>
                    </tr>
                    <tr>
                        <th>Cor:</th>
                        <td><?= $veiculo->color?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.bl_horizTable -->

            <div id="legalcopy">
                <h2>Comentário:</h2>
                <p><?= $venda->comment ?></p>
            </div>

        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->
</div><!-- End Invoice Holder-->

<a onClick="window.print()" class="btn btn-outline-primary" src="/css/icons/imprimir.png" >Imprimir Página</a>

<style>

    @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);

    * {
        margin: 0;
        box-sizing: border-box;

    }

    ::selection {
        background: #f31544;
        color: #FFF;
    }

    h1 {
        font-size: 1.5em;
        color: #222;
    }

    h2 {
        font-size: .9em;
    }

    h3 {
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }

    p {
        font-size: .7em;
        color: #666;
        line-height: 1.2em;
    }

    #invoiceholder {
        width: 100%;
        padding-top: 50px;
    }

    #headerimage {
        z-index: -1;
        position: relative;
        top: -50px;
        height: 350px;
        background-image: url('http://michaeltruong.ca/images/invoicebg.jpg');

        -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, .15), inset 0 -2px 4px rgba(0, 0, 0, .15);
        -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, .15), inset 0 -2px 4px rgba(0, 0, 0, .15);
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, .15), inset 0 -2px 4px rgba(0, 0, 0, .15);
        overflow: hidden;
        background-attachment: fixed;
        background-size: 1920px 80%;
        background-position: 50% -90%;
    }

    #invoice {
        position: relative;
        top: -290px;
        margin: 0 auto;
        width: 700px;
        background: #FFF;
    }

    [id*='invoice-'] { /* Targets all id with 'col-' */
        border-bottom: 1px solid #EEE;
        padding: 30px;
    }

    #invoice-top {
        min-height: 120px;
    }

    #invoice-mid {
        min-height: 120px;
    }

    #invoice-bot {
        min-height: 250px;
    }

    .clientlogo {
        float: left;
        height: 60px;
        width: 60px;
        background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
    }

    .info {
        display: block;
        float: left;
        margin-left: 20px;
    }

    .title {
        float: right;
    }

    .title p {
        text-align: right;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 5px 0 5px 15px;
        border: 1px solid #EEE
    }

    .tabletitle {
        padding: 5px;
        background: #EEE;
    }

    .service {
        border: 1px solid #EEE;
    }

    .item {
        width: 50%;
    }

    .itemtext {
        font-size: .9em;
    }

    form {
        float: right;
        margin-top: 30px;
        text-align: right;
    }

    .effect2 {
        position: relative;
    }

    .effect2:before, .effect2:after {
        z-index: -1;
        position: absolute;
        content: "";
        bottom: 15px;
        left: 10px;
        width: 50%;
        top: 80%;
        max-width: 300px;
        background: #777;
        -webkit-box-shadow: 0 15px 10px #777;
        -moz-box-shadow: 0 15px 10px #777;
        box-shadow: 0 15px 10px #777;
        -ms-transform: rotate(-3deg);
        transform: rotate(-3deg);
    }

    .effect2:after {
        -ms-transform: rotate(3deg);
        transform: rotate(3deg);
        right: 10px;
        left: auto;
    }

    .bl_horizTable {
        border: 1px solid #ddd;
    }

    .bl_horizTable table {
        width: 100%;
    }

    .bl_horizTable th {
        width: 20%;
        padding: 15px;
        background-color: #efefef;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        vertical-align: middle;
    }

    .bl_horizTable td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .bl_horizTable tr:last-child th,
    .bl_horizTable tr:last-child td {
        border-bottom-width: 0;
    }

</style>