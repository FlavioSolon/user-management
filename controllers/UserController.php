<?php
namespace app\controllers;

use app\services\UserService;
use app\strategies\AdminPermissionStrategy;
use app\strategies\UserPermissionStrategy;
use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    private $userService;

    public function __construct($id, $module, UserService $userService, $config = [])
    {
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $strategy = Yii::$app->user->identity->role === 'admin'
                                ? new AdminPermissionStrategy()
                                : new UserPermissionStrategy();
                            return $strategy->{"can" . ucfirst($action->id)}();
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('Usuário não encontrado.');
        }
        return $this->render('view', ['model' => $user]);
    }

    public function actionCreate()
    {
        $model = new User();
        try {
            if (Yii::$app->request->isPost) {
                $user = $this->userService->create(Yii::$app->request->post('User'));
                return $this->redirect(['view', 'id' => $user->id]);
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->userService->findById($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Usuário não encontrado.');
        }
        try {
            if (Yii::$app->request->isPost) {
                $this->userService->update($id, Yii::$app->request->post('User'));
                return $this->redirect(['view', 'id' => $id]);
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        try {
            $this->userService->delete($id);
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }
}