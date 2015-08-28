<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="addons-list-widget">
    <div class="alert alert-warning">
        <b>@todo</b> выводить аддоны по категориям!!!
    </div>
<?php foreach ($bindedAddons as $addon): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="pull-right btn-group">

                <div class="btn btn-xs btn-default">
                    <?php
                    $currency = \app\modules\shop\models\Currency::findById($addon->currency_id);
                    echo $currency->format($addon->price);

                    ?>

                </div>
                <?= Html::a(
                    \kartik\icons\Icon::show('trash-o') . ' ' . Yii::t('app', 'Delete'),
                    '#',
                    [
                        'data-id' => $addon->id,
                        'class' => 'btn btn-xs btn-danger remove-addon',
                    ]
                ) ?>
            </div>
            <?= Html::encode($addon->name) ?>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php
$url = \yii\helpers\Json::encode(Url::to(['/shop/backend-addons/add-addon-binding','remove'=>1, 'object_id' => $object_id, 'object_model_id' => $object_model_id]));
$js = <<<JS
$('.remove-addon').click(function() {
    var id = $(this).data('id');
    $.ajax({
        url: $url,
        data: {
            addon_id: id
        },
        method: 'POST',
        success: function(data) {
            $(".addons-list-widget").replaceWith($(data.data));
        }
    });
    return false;
});
JS;
$this->registerJs($js);
