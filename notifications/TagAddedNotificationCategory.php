<?php
/**
 * Created by PhpStorm.
 * User: skonb
 * Date: 2018/02/27
 * Time: 19:42
 */

namespace humhub\modules\custom_user_tag\notifications;

use humhub\modules\notification\components\NotificationCategory;
use humhub\modules\notification\targets\BaseTarget;
use humhub\modules\notification\targets\MailTarget;
use humhub\modules\notification\targets\MobileTarget;
use humhub\modules\notification\targets\WebTarget;
use Yii;

/**
 * SpaceMemberNotificationCategory
 *
 * @author buddha
 */
class TagAddedNotificationCategory extends NotificationCategory
{

    /**
     * @inheritdoc
     */
    public $id = 'tag_added';

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('CustomUserTagModule.notification', 'Tag Added');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return Yii::t('CustomUserTagModule.notification', 'Receive Notifications for New Taggings to your profile.');
    }

    /**
     * @inheritdoc
     */
    public function getDefaultSetting(BaseTarget $target)
    {
        if ($target->id === MailTarget::getId()) {
            return true;
        } else if ($target->id === WebTarget::getId()) {
            return true;
        } else if ($target->id === MobileTarget::getId()) {
            return true;
        }

        return $target->defaultSetting;
    }

}