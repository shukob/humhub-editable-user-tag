<?php
/**
 * Created by PhpStorm.
 * User: skonb
 * Date: 2018/02/24
 * Time: 18:40
 */

namespace humhub\modules\custom_user_tag\controllers;


use humhub\components\Controller;
use humhub\modules\custom_user_tag\models\CustomUserTag;
use humhub\modules\custom_user_tag\models\forms\AddUserTagForm;
use Yii;
use yii\helpers\Url;
use yii\log\Logger;

class TagController extends Controller
{
    public function actionSearchCustomUserTag()

    {

        if (Yii::$app->request->isAjax) {
            $query = Yii::$app->request->get('query');
            if (!empty($query)) {
                $find = CustomUserTag::find()->andFilterWhere(['like', 'title', $query])->select('title');
                $allModels = $find->column();
                echo json_encode([
                    'suggestions' => $allModels
                ]);
            } else {
                echo json_encode(['status' => 'failure']);
            }
        }
    }

    public function actionAddCustomUserTag()
    {

    }

    public function actionCreate()
    {
        $model = new AddUserTagForm();
        $model->userGuid = Yii::$app->request->get('userGuid');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $model->getUser();
            Yii::getLogger()->log($model, Logger::LEVEL_ERROR);
            $user->tags .= "," . $model->title;
            $user->save();
            return $this->htmlRedirect(Url::to(['/user/profile', 'uguid' => $model->userGuid]));
        }
        return $this->renderAjax('create', array('model' => $model));

    }

}