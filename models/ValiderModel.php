<?php

/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 15/08/2019
 * Time: 23:51
 */

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class ValiderModel extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'ID_HABILITE', 'ID_HABILITE'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['ID_HABILITE']) && !empty($item['ID_HABILITE']) && isset($multipleModels[$item['ID_HABILITE']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}
