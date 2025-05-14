<?php
use yii\helpers\Html;
use yii\grid\GridView; // Alterado para yii\grid\GridView

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Usuário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'email:email',
        'registration_number',
        'role',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'visibleButtons' => [
                'update' => function ($model) {
                    return Yii::$app->user->identity->role === 'admin';
                },
                'delete' => function ($model) {
                    return Yii::$app->user->identity->role === 'admin';
                },
            ],
        ],
    ],
]) ?>