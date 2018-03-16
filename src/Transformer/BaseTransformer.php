<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/8
 */

namespace Koala\Lib\Transformer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{

    /**
     * 需要被隐藏的字段
     * @var array
     */
    protected $hidden = [];

    /**
     * @param $model
     * @return array|mixed
     */
    public function transform($model)
    {
        $current = false;
        $result = [];
        if ($model instanceof Model) {
            $current = true;
            $model = new Collection([$model]);
        }

        if ($model instanceof Collection) {
            foreach ($model as $item) {
                $data = $this->setData($item);
                if (!$this->defaultIncludes) {
                    $this->processRelationResources($item, $data);
                }

                $result[] = $this->filter($data);
            }

        }

        if ($current) {
            $result = current($result);
        }

        return $result;
    }


    protected function setData(Model $item)
    {
        $data = [];

        $hiddenFields = array_merge($item->getHidden(), $this->getHidden());
        foreach ($this->getAttributes($item) as $attribute => $value) {
            if (!in_array($attribute, $hiddenFields)) {
                $data[$this->toUnderScore($attribute)] = $item->$attribute;
            }
        }

        return $data;
    }

    /**
     * @param Model $item
     * @return array
     */
    protected function getAttributes(Model $item)
    {
        $attributes = $item->getAttributes();
        $hiddenFields = $item->getHidden();
        if (count($hiddenFields) > 0) {
            $attributes = array_diff_key($attributes, array_flip($hiddenFields));
        }

        return $attributes;
    }

    /**
     * 驼峰转化为下划线
     * @param $str
     * @return mixed
     */
    protected function toUnderScore($str)
    {
        $str = preg_replace_callback('/([A-Z])/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $str);

        return $str;
//        return trim(preg_replace('/_{2,}/', '_', $str), '_');
    }

    /**
     * todo 处理关系数据
     * @param Model $model
     * @param $data
     */
    protected function processRelationResources(Model $model, &$data)
    {
        $result = [];
        foreach ($model->getRelations() as $relation) {
            print_r($relation);die;
        }
    }

    /**
     * todo 过滤数据
     * @param $data
     * @return mixed
     */
    protected function filter($data)
    {
        return $data;
    }

    /**
     * @return array
     */
    public function getHidden(): array
    {
        return $this->hidden;
    }

    /**
     * @param array $hidden
     */
    public function setHidden(array $hidden)
    {
        $this->hidden = $hidden;
    }


}