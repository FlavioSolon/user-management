<?php
use yii\helpers\Html;

$this->title = 'Criar Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="user-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>