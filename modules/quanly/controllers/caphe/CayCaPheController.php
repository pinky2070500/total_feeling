<?php

namespace app\modules\quanly\controllers\caphe;
use app\modules\quanly\base\QuanlyBaseController;

use Yii;
use app\modules\quanly\models\caphe\CayCaPhe;
use app\modules\quanly\models\caphe\CayCaPheSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * CayCaPheController implements the CRUD actions for CayCaPhe model.
 */
class CayCaPheController extends QuanlyBaseController
{
    public $const;
    public $title = "Cây cà phê";

    public function init(){
        parent::init();
            $this->const = [
            'title' => 'Cây cà phê',
            'label' => [
                'index' => 'Danh sách',
                'create' => 'Thêm mới',
                'update' => 'Cập nhật',
                'view' => 'Thông tin chi tiết',
                'statistic' => 'Thống kê',
            ],
            'url' => [
                'index' => 'index',
                'create' => 'Thêm mới',
                'update' => 'Cập nhật',
                'view' => 'Thông tin chi tiết',
                'statistic' => 'Thống kê',
            ],
        ];
    }

    /**
     * Lists all CayCaPhe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CayCaPheSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single CayCaPhe model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CayCaPhe model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new CayCaPhe();

        $table = '"4326_cay_caphe"';

        if ($model->load($request->post()) && $model->save()) {
            Yii::$app->db->createCommand("UPDATE".$table."SET geom = ST_GeomFromText('POINT($model->long"." "."$model->lat 0)', 4326) WHERE id = :id")
            ->bindValue(':id', $model->id)
            ->execute();

            Yii::$app->db->createCommand("UPDATE".$table."SET geojson = st_asgeojson(ST_GeomFromText('POINT($model->long"." "."$model->lat 0)', 4326)) WHERE id = :id")
            ->bindValue(':id', $model->id)
            ->execute();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing CayCaPhe model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $table = '"4326_cay_caphe"';

        //$oldGeomGeojson = $model->geojson;

        if ($model->load($request->post())) {

            $model->save();

            Yii::$app->db->createCommand("UPDATE".$table."SET geom = ST_GeomFromText('POINT($model->long"." "."$model->lat 0)', 4326) WHERE id = :id")
            ->bindValue(':id', $model->id)
            ->execute();

            Yii::$app->db->createCommand("UPDATE".$table."SET geojson = st_asgeojson(ST_GeomFromText('POINT($model->long"." "."$model->lat 0)', 4326)) WHERE id = :id")
            ->bindValue(':id', $model->id)
            ->execute();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Delete an existing CayCaPhe model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->status = 0;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Xóa #" . $id,
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-light float-right', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Xóa', ['class' => 'btn btn-danger float-left', 'type' => "submit"])
                ];
            } else if ($request->isPost && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Xóa thành công #" . $id,
                    'content' => '<span class="text-success">Xóa thành công</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-light float-right', 'data-bs-dismiss' => "modal"])
                ];
            } else {
                return [
                    'title' => "Update #" . $id,
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-light float-right', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        }
    }

    
    /**
     * Finds the CayCaPhe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CayCaPhe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CayCaPhe::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
