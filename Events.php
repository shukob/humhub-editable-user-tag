<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\custom_user_tag;

use humhub\modules\custom_user_tag\models\CustomUserTag;
use humhub\modules\custom_user_tag\widgets\AddTagButton;
use Yii;
use yii\base\Event;

/**
 * Description of Events
 *
 * @author luke
 */
class Events extends \yii\base\Object
{

    /**
     * On User delete, also delete all comments
     *
     * @param type $event
     */
    public static function onUserUpdate(Event $event)
    {

        CustomUserTag::handleUpdateUserTags($event->sender);
        return true;
    }


    public static function onProfileHeaderControlsInit(Event $event)
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        $event->sender->addWidget(AddTagButton::className(), array('guid' => $event->sender->user->guid, 'type' => 'info'), array('sortOrder' => 90));
    }

}
