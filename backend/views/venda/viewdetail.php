<?php
$desconto = 0;

if($venda->price < $veiculo->price){
    $desconto = $venda->price - $veiculo->price ;
}

$brandName = $veiculo->getBrandName();
$modelName = $veiculo->getModelName();

?>

<div id="invoiceholder">

    <div id="headerimage"></div>
    <div id="invoice" class="effect2">

        <div id="invoice-top">
            <div class="clientlogo"></div>
            <div class="info">
                <h2>Vendedor:</h2>
                <p> <?= $vendedor->name; ?><br>
                    <?= $vendedor->email; ?><br>
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
                <p> <?= $venda->name; ?><br> Telefone: <?= $venda->number; ?> | Nif: <?= $venda->nif; ?>
                </p>
            </div>
        </div>

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
                        <td class="tableitem"><p class="itemtext"><?= $veiculo->id; ?></p></td>
                        <td class="tableitem"><p
                                    class="itemtext"><?php echo $brandName . ' ' . $modelName . '(' . $veiculo->plate . ')'; ?></p>
                        </td>
                        <td class="tableitem"><p class="itemtext"><?= $veiculo->price ?>€</p></td>
                        <td class="tableitem"><p class="itemtext"><?= $venda->price ?>€</p></td>
                        <td class="tableitem"><p class="itemtext"><?= $desconto ?>€</p></td>
                    </tr>

                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="payment"><h2>Total: <?= $venda->price ?>€</h2></td>
                    </tr>
                </table>
            </div><!--End Table-->

            <br>
            <h6>Detalhe do Veículo:</h6>
            <div class="bl_horizTable">
                <table>
                    <tbody>
                    <tr>
                        <th>Matrícula:</th>
                        <td><?= $veiculo->plate ?></td>
                    </tr>
                    <tr>
                        <th>Marca:</th>
                        <td><?= $brandName ?></td>
                    </tr>
                    <tr>
                        <th>Modelo:</th>
                        <td><?= $modelName ?></td>
                    </tr>
                    <tr>
                        <th>Serie:</th>
                        <td><?= $veiculo->serie == "" ? "-" : $veiculo->serie ?></td>
                    </tr>
                    <tr>
                        <th>Tipologia:</th>
                        <td><?= $veiculo->type ?></td>
                    </tr>
                    <tr>
                        <th>Combustível:</th>
                        <td><?= $veiculo->fuel ?></td>
                    </tr>
                    <tr>
                        <th>Quilómetro:</th>
                        <td><?= $veiculo->mileage ?> km</td>
                    </tr>
                    <tr>
                        <th>Ano:</th>
                        <td><?= $veiculo->year ?></td>
                    </tr>
                    <tr>
                        <th>Cilindrada:</th>
                        <td><?= $veiculo->engine ?> cm3</td>
                    </tr>
                    <tr>
                        <th>CV:</th>
                        <td><?= $veiculo->cv ?> cm3</td>
                    </tr>
                    <tr>
                        <th>Caixa:</th>
                        <td><?= $veiculo->transmission ?></td>
                    </tr>
                    <tr>
                        <th>NºPortas:</th>
                        <td><?= $veiculo->doorNumber ?></td>
                    </tr>
                    <tr>
                        <th>Cor:</th>
                        <td><?= $veiculo->color ?></td>
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

<a onClick="window.print()" class="btn btn-outline-primary">Imprimir Página</a>

<style>
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

    [id*='invoice-'] {
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