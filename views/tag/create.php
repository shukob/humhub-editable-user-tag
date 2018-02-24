<?php

use keygenqt\autocompleteAjax\AutocompleteAjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="modal-dialog">
    <div class="modal-content">
        <?php $form = ActiveForm::begin(['id' => 'create-tag-form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t("CustomUserTagModule.views_tag_create", "Add Tag"); ?></h4>
        </div>
        <div class="modal-body">

            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->field($model, 'userGuid')->hiddenInput(['value' => $model->userGuid])->label(false); ?>
            <?=
            \muhiddin\autocomplete\AutoComplete::widget([
                'id' => 'search',
                'form' => $form, // ActiveForm widget object
                'model' => $model, // model
                'attribute' => 'title', // attribute of model
                'value' => '',
                'name' => 'title',
                'options' => [
                    'class' => 'form-control form-group-margin',
                    'dir' => "ltr",
                    'placeholder' => Yii::t("CustomUserTagModule.views_tag_create", "Type a tag..."),
                ],
                'pluginOptions' => [
                    'minChars' => 1,
                    'serviceUrl' => \yii\helpers\Url::toRoute(['tag/search-custom-user-tag']),
                    'width' => '40%',
                    'onSelect' => 'function(suggestion){
                                        // call onselect found element function
                                    
                                    }'
                ]
            ]);
            ?>
        </div>
        <div class="modal-footer">
            <?php
            echo
            \humhub\widgets\AjaxButton::widget([
                'label' => Yii::t('CustomUserTagModule.views_tag_create', 'Add'),
                'ajaxOptions' => [
                    'type' => 'POST',
                    'beforeSend' => '$.proxy(function() { $(this).prop("disabled",true); },this)',
                    'success' => 'function(html){ $("#globalModal").html(html); }',
                    'url' => Url::to(['/custom_user_tag/tag/create']),
                ],
                'htmlOptions' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
            ?>

            <button type="button" class="btn btn-primary"
                    data-dismiss="modal"><?php echo Yii::t('CustomUserTagModule.views_tag_create', 'Close'); ?></button>

        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>

