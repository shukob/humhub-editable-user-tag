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
use humhub\modules\custom_user_tag\notifications\TagAddedNotification;
use Yii;
use yii\base\InvalidConfigException;
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


    public function actionCreate()
    {
        $model = new AddUserTagForm();
        $model->userGuid = Yii::$app->request->get('userGuid');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $model->getUser();
            $user->tags .= "," . $model->title;
            $user->save();
            if (Yii::$app->user->getIdentity()->getId() != $user->getId()) {
                try {
                    $tag = CustomUserTag::findOne(['title' => $model->title]);
                    TagAddedNotification::instance()->from(Yii::$app->user->getIdentity())->withTagTitle($model->title)->about($tag)->send($user);
                } catch (InvalidConfigException $e) {
                    Yii::getLogger()->log($e, Logger::LEVEL_ERROR);
                }
            }
            return $this->htmlRedirect(Url::to(['/user/profile', 'uguid' => $model->userGuid]));
        }
        return $this->renderAjax('create', array('model' => $model));

    }

}