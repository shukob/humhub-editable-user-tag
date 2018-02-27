<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\custom_user_tag\notifications;

use humhub\modules\notification\components\BaseNotification;
use Yii;
use yii\bootstrap\Html;

/**
 * TagAddedNotification
 *
 * @since 0.5
 */
class TagAddedNotification extends BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = "custom_user_tag";

    /**
     * @inheritdoc
     */
    public $viewName = "tag_added";
    public $tagTitle;

    /**
     * @inheritdoc
     */
    public $markAsSeenOnClick = false;

    /**
     * Sets the approval request message for this notification.
     *
     * @param string $message
     */
    public function withTagTitle($tagTitle)
    {
        if ($tagTitle) {
            $this->tagTitle = $tagTitle;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getViewParams($params = array())
    {
        return \yii\helpers\ArrayHelper::merge(parent::getViewParams(['tagTitle' => $this->tagTitle ]), $params);
    }

    /**
     * @inheritdoc
     */
    public function getMailSubject()
    {
        return Yii::t('CustomUserTagModule.notification', '{displayName} added tag {tagTitle}', [
            '{displayName}' => Html::encode($this->originator->displayName),
            '{tagTitle}' => Html::encode($this->source->title)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function category()
    {
        return new TagAddedNotificationCategory();
    }

    /**
     * @inheritdoc
     */
    public function html()
    {

        return Yii::t('CustomUserTagModule.notification', '{displayName} added tag {tagTitle}', [
            '{displayName}' => Html::encode($this->originator->displayName),
            '{tagTitle}' => Html::encode($this->source->title)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function serialize()
    {
        return serialize(['source' => $this->source, 'originator' => $this->originator, 'tagTitle' => $this->tagTitle]);
    }

    /**
     * @inheritdoc
     */
    public function unserialize($serialized)
    {
        $this->init();
        $unserializedArr = unserialize($serialized);
        $this->from($unserializedArr['originator']);
        $this->about($unserializedArr['source']);
        $this->withTagTitle($unserializedArr['tagTitle']);
    }

}

?>