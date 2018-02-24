<?php

namespace humhub\modules\custom_user_tag\models;

use humhub\modules\mail\notifications\ConversationNotificationCategory;

use humhub\modules\notification\targets\BaseTarget;
use humhub\modules\notification\targets\MailTarget;
use Yii;
use humhub\components\ActiveRecord;
use humhub\models\Setting;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $id
 * @property string $title
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property MessageEntry[] $messageEntries
 * @property User[] $users
 *
 * @package humhub.modules.mail.models
 * @since 0.5
 */
class CustomUserTag extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'custom_user_tag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(['title'], 'string', 'max' => 255),
            array('title', 'unique'),
            array(['created_at', 'updated_at'], 'safe'),
        );
    }

    public static function handleUpdateUserTags(User $user)
    {
        foreach ($user->getTags() as $tag) {
            if (!CustomUserTag::find()->where(['title' => $tag])->exists()) {
                (new CustomUserTag(['title' => $tag]))->save();
            }
        }
    }

    /**
     * Returns static class instance, which can be used to obtain meta information.
     * @param bool $refresh whether to re-create static instance even, if it is already cached.
     * @return static class instance.
     */
    public static function instance($refresh = false)
    {
        // TODO: Implement instance() method.
    }
}
