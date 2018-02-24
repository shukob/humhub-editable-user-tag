<?php
/**
 * Created by PhpStorm.
 * User: skonb
 * Date: 2018/02/24
 * Time: 19:29
 */

namespace humhub\modules\custom_user_tag\models\forms;

use humhub\modules\user\models\User;
use Yii;
use yii\log\Logger;

class AddUserTagForm extends \yii\base\Model
{
    public $title;
    public $userGuid;
    public $user;

    public function rules()
    {
        return array(
            [['title', 'userGuid'], 'required'],
            ['title', 'uniqueInUser']
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'title' => Yii::t('CustomUserTagModule.views_tag_create', 'Title'),
        );
    }


    public function getUser()
    {
        if (!$this->user) {
            if ($this->userGuid) {
                $this->user = User::findOne(['guid' => $this->userGuid]);
            }
        }
        return $this->user;
    }

    public function uniqueInUser($attribute, $params, $validator)
    {
        Yii::getLogger()->log($attribute, Logger::LEVEL_ERROR);
        if ($this->getUser()) {
            $tolower = function ($val) {
                return strtolower($val);
            };
            if (in_array(strtolower($this->title), array_map($tolower, $this->getUser()->getTags()))) {
                $this->addError($attribute, Yii::t('CustomUserTagModule.views_tag_create', 'Already Tagged'));
            }
        }
    }
}