<?php

use yii\helpers\Url;

?>
    <th scope="row">
        <a href="<?= Url::toRoute(['vendauser/view', 'id' => $model->id]) ?>" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill"
                 viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
        </a>
    </th>
    <td> <?= $model->plate ?></td>
    <td><?= $model->brand ?></td>
    <td><?= $model->model ?></td>
    <td><?= $model->price ?>€</td>

    <?php
    if ($model->status == 'Aceite') {
        echo '<td><span class="badge bg-success">' . $model->status . '</span></td>';
    } elseif ($model->status == 'Por ver') {
        echo '<td><span class="badge bg-secondary">' . $model->status . '</span></td>';

    } elseif($model->status == 'Recusado') {
        echo '<td><span class="badge bg-danger">' . $model->status . '</span></td>';
    }else{
        echo '<td><span class="badge bg-primary">' . $model->status . '</span></td>';
    }
    ?>
</tr>