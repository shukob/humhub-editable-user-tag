<?php

namespace humhub\modules\custom_user_tag\widgets;

use Yii;
use humhub\components\Widget;

/**
 * @package humhub.modules.mail
 * @since   0.5.9
 */
class AddTagButton extends Widget
{

    public $guid = null;
    public $id = null;
    public $type = 'default';
    public $size = null;

    /**
     * Creates the Wall Widget
     */
    public function run()
    {

        $class = 'btn btn-' . $this->type;
        if (!empty($this->size)) {
            $class .= ' btn-' . $this->size;
        }

        $params = array(
            'guid' => $this->guid,
            'id' => $this->id,
            'class' => $class,
        );

        // if guid is set, then change button label to "Send message"
        $params['buttonLabel'] = Yii::t('CustomUserTagModule.widgets_views_editTagButton', 'Add Tag');

        return $this->render('addTagButton', $params);
    }

}

?>