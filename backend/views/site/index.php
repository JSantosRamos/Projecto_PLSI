<?php

/** @var yii\web\View $this */

use common\models\User;

$this->title = 'Stand Auto Gestão';

if ($tarefas > 0) {
    $percTarefasPorRealizar = ($tarefasStatus["porIniciar"] * 100) / $tarefas;
    $percTarefasAdecorrer = ($tarefasStatus["emProcesso"] * 100) / $tarefas;
} else {
    $percTarefasPorRealizar = 0;
    $percTarefasAdecorrer = 0;
}

?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Vendas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $vendas ?> €</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Despesas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $despesas ?> €</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tarefas por
                                    realizar
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?= $tarefasStatus["porIniciar"] . '/' . $tarefas ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                 style="width: <?= $percTarefasPorRealizar ?>%" aria-valuenow="50"
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tarefas a decorrer
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?= $tarefasStatus["emProcesso"] . '/' . $tarefas ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                 style="width: <?= $percTarefasAdecorrer ?>%"
                                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Test-Drives
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $drives ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-car fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Propostas de Compra
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $propostas ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-car fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Utilizadores
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $usersAtivos . '/' . $users ?> Activos
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Veículos
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $veiculos ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-car fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-4">
                <canvas id="chart-drive" width="1500" height="450"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="chart-venda" width="1500" height="450"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="chart-vehicle" width="1500" height="450"></canvas>
            </div>
        </div>
        <br>

        <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
            <h3>Compras e Vendas</h3>
            <div>
                <canvas id="bar-chart-horizontal" width="3000" height="450"></canvas>
            </div>
        <?php endif; ?>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>

    let aceite_drive = <?= $driveArray["aceite"] ?>;
    let recusado_drive = <?= $driveArray["recusado"] ?>;
    let porVer_drive = <?= $driveArray["por_ver"] ?>;
    let resposta_drive = <?= $driveArray["aguardar_resposta"] ?>;

    new Chart(document.getElementById("chart-drive"), {
        type: 'doughnut',
        data: {
            labels: ["Por Ver", "Aguardar Resposta", "Aceite", "Recusado"],
            datasets: [
                {
                    label: "Test-Drives",
                    backgroundColor: ["#6C757D", "#17A2B8", "#28A745", "#DC3545"],
                    data: [porVer_drive, resposta_drive, aceite_drive, recusado_drive]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Test-Drives'
            }
        }
    });


    let aceite_venda = <?= $propostasArray["aceite"] ?>;
    let recusado_venda = <?= $propostasArray["recusado"] ?>;
    let analise_venda = <?= $propostasArray["emAnalise"] ?>;
    let porVer_venda = <?= $propostasArray["porVer"] ?>;
    let resposta_venda = <?= $propostasArray["resposta"] ?>;

    new Chart(document.getElementById("chart-venda"), {
        type: 'doughnut',
        data: {
            labels: ["Por Ver", "Em análise", "Aguardar Resposta", "Aceite", "Recusado"],
            datasets: [
                {
                    label: "Test-Drives",
                    backgroundColor: ["#6C757D", "#007BFF", "#17A2B8", "#28A745", "#D81717"],
                    data: [porVer_venda, analise_venda, resposta_venda, aceite_venda, recusado_venda]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Propostas de Vendas'
            }
        }
    });

    let vendido = <?= $veiculosArray["vendido"] ?>;
    let reservado = <?= $veiculosArray["reservado"] ?>;
    let disponivel = <?= $veiculosArray["disponivel"] ?>;

    new Chart(document.getElementById("chart-vehicle"), {
        type: 'doughnut',
        data: {
            labels: ["Vendidos", "Reservados", "Disponiveis"],
            datasets: [
                {
                    label: "Test-Drives",
                    backgroundColor: ["#28A745", "#ffc107", "#007BFF"],
                    data: [vendido, reservado, disponivel]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Veículos'
            }
        }
    });

    let vendasTotal = <?= $vendas?>;
    let comprasTotal = <?= $comprasTotal?>;

    new Chart(document.getElementById("bar-chart-horizontal"), {
        type: 'horizontalBar',
        data: {
            labels: ["Vendas", "Compras"],
            datasets: [
                {
                    label: "Compras/Vendas",
                    backgroundColor: ["#17D84B", "#D81717"],
                    data: [vendasTotal, comprasTotal]
                }
            ]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: 'Valor total em compra e venda de veículos.'
            }
        }
    });

</script>
