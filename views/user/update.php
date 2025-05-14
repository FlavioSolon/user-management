<?php
use yii\helpers\Html;

$this->title = 'Atualizar Usuário: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="user-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>