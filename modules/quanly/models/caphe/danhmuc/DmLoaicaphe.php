<?php

namespace app\modules\quanly\models\caphe\danhmuc;
use app\modules\quanly\base\QuanlyBaseModel;

use Yii;

/**
 * This is the model class for table "dm_loaicaphe".
 *
 * @property int $id
 * @property string|null $ten
 * @property string|null $ghichu
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CayCapheDatrong[] $cayCapheDatrongs
 */
class DmLoaicaphe extends QuanlyBaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_loaicaphe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten', 'ghichu'], 'string'],
            [['status', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Tên',
            'ghichu' => 'Ghi chú',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CayCapheDatrongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCayCapheDatrongs()
    {
        return $this->hasMany(CayCapheDatrong::className(), ['loaicaphe_id' => 'id']);
    }
}
