<?php

namespace humhub\modules\custom_user_tag\controllers;

use yii\web\Controller;

/**
 * Default controller for the `custom_user_tag` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
