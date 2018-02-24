<?php

use yii\helpers\Html;

/**
 * @var string $buttonLabel
 * @var string $guid
 * @var string $id
 * @var string $class
 */
echo Html::a($buttonLabel, ['/custom_user_tag/tag/create', 'ajax' => 1, 'userGuid' => $guid], array('class' => $class, 'id' => $id, 'data-target' => '#globalModal'));
?>
