?php

use humhub\modules\user\models\User;
use humhub\modules\user\widgets\ProfileHeaderControls;

return [
    'id' => 'custom_user_tag',
    'class' => 'humhub\modules\custom_user_tag\Module',
    'namespace' => 'humhub\modules\custom_user_tag',
    'events' => [
        ['class' => User::className(), 'event' => User::EVENT_AFTER_UPDATE, 'callback' => ['humhub\modules\custom_user_tag\Events', 'onUserUpdate']],
        ['class' => ProfileHeaderControls::className(), 'event' => ProfileHeaderControls::EVENT_INIT, 'callback' => ['humhub\modules\custom_user_tag\Events', 'onProfileHeaderControlsInit']],
    ],
];
?>
