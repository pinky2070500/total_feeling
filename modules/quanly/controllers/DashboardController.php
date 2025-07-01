<?php


namespace app\modules\quanly\controllers;


use app\modules\quanly\base\QuanlyBaseController;
use app\modules\quanly\models\caphe\CayCaPhe;
use app\modules\quanly\models\caphe\CayChuoi;
use app\modules\quanly\models\caphe\CayGaoVang;
use app\modules\quanly\models\caphe\CayNganHoa;
use app\modules\quanly\models\caphe\CaySenKhac;
use Yii;

class DashboardController extends QuanlyBaseController
{
    public function actionIndex()
    {
        Yii::$app->cache->flush();
        $thongke['CayCaPhe'] = CayCaPhe::find()->count();
        $thongke['CayChuoi'] = CayChuoi::find()->count();
        $thongke['CayGaoVang'] = CayGaoVang::find()->count();
        $thongke['CayNganHoa'] = CayNganHoa::find()->count();
        $thongke['CaySenKhac'] = CaySenKhac::find()->count();   

        return $this->render('index', [
            'thongke' => $thongke,
        ]);
    }

    public function actionGeojson(){
        $dmas = Yii::$app->db->createCommand('SELECT st_asgeojson(geom) as geometry, madma as ten, id  FROM "v2_4326_DMA" order by madma')->queryAll();

        $g  = [];

        foreach ($dmas as $i => $dma) {
            $geometry = json_decode($dma['geometry'], true);
            $g[$i] = [
                'type' => 'Feature',
                'id' => $dma['id'],
                'properties' => [
                    'name' => $dma['ten'],
                ],
                'geometry' => [
                    'type' => $geometry['type'],
                    'coordinates' => $geometry['coordinates'],
                ]
            ];
        }

        $e = [
            'type' => 'FeatureCollection',
            'features' => $g
        ];

        //dd($e);
        return json_encode($e, JSON_UNESCAPED_UNICODE);

        //dd($results);
    }

    public function actionChitietdma($id){

        

      
       

       return $this->renderAjax('chitietdma', [
           'id'=>$id,
           
       ]); 
   }


}