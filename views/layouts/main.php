<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\Breadcrumbs;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            transition: width 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar.collapsed {
            width: 60px;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.2em;
        }
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .logo {
            display: none;
        }

        .toggle-btn {
            position: absolute;
            top: 10px;
            right: -30px;
            width: 30px;
            height: 30px;
            background-color: #343a40;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .sidebar.collapsed .toggle-btn {
            transform: rotate(180deg);
        }

        .logo {
            text-align: center;
            padding: 20px 0;
        }
        .logo img {
            max-width: 150px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
            padding-bottom: 60px; /* espaço para a paginação fixa */
        }
        .sidebar.collapsed ~ .content {
            margin-left: 60px;
        }

        .user-avatar {
            position: fixed;
            top: 10px;
            right: 20px;
            background-color: #343a40;
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            z-index: 1050;
            font-weight: bold;
            user-select: none;
        }
        .avatar-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            z-index: 1051;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .avatar-menu .dropdown-item {
            padding: 10px 15px;
            display: block;
            color: #000;
            text-decoration: none;
        }
        .avatar-menu .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .pagination-footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            width: calc(100% - 250px);
            background: #fff;
            padding: 10px;
            text-align: center;
            border-top: 1px solid #ccc;
            z-index: 1001;
        }
        .sidebar.collapsed ~ .pagination-footer {
            left: 60px;
            width: calc(100% - 60px);
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="user-avatar" id="userAvatar">
        <?= strtoupper(substr(Yii::$app->user->identity->name, 0, 2)) ?>
        <div class="avatar-menu" id="avatarMenu">
            <?= Html::beginForm(['/auth/logout'], 'post') ?>
            <?= Html::submitButton('Logout', ['class' => 'dropdown-item']) ?>
            <?= Html::endForm() ?>
        </div>
    </div>
<?php endif; ?>

<nav class="sidebar" id="sidebar">
    <div class="toggle-btn" id="toggleBtn">
        <i class="bi bi-arrow-left"></i>
    </div>
    <div class="logo">
        <img src="/images/logo.png" alt="Logo">
    </div>
    <?php
    $menuItems = [
        [
            'label' => '<i class="bi bi-house"></i> <span>Home</span>',
            'url' => ['/site/index'],
            'encode' => false,
        ],
        [
            'label' => '<i class="bi bi-key"></i> <span>Controle de Acesso</span>',
            'encode' => false,
            'items' => [
                ['label' => '<i class="bi bi-person"></i> Usuários', 'url' => ['/user/index'], 'encode' => false],
            ],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => '<i class="bi bi-box-arrow-in-right"></i> <span>Login</span>',
            'url' => ['/auth/login'],
            'encode' => false,
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'nav flex-column'],
        'items' => $menuItems,
        'activateParents' => true,
    ]);
    ?>
</nav>

<div class="content">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger">
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <?= $content ?>
    </div>
</div>

<!-- Paginação fixa no rodapé -->
<?php if (isset($this->params['pagination'])): ?>
    <div class="pagination-footer">
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $this->params['pagination']
        ]) ?>
    </div>
<?php endif; ?>

<script>
    document.getElementById('toggleBtn').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('collapsed');
    });

    const avatar = document.getElementById('userAvatar');
    const menu = document.getElementById('avatarMenu');

    if (avatar) {
        avatar.addEventListener('click', () => {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function (e) {
            if (!avatar.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    }
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
