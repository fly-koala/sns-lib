<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/8
 */

namespace Koala\Lib\Response;

use Koala\Lib\Transformer\BaseTransformer;
use Closure;
use Dingo\Api\Http\Response\Factory as DingoFactory;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * 追加了默认Transformer-没有其他逻辑修改
 * Class Factory
 * @package App\Lib\Response
 */
class Factory extends DingoFactory
{
    use DetectsApplicationNamespace;

    /**
     * 当前控制器名称
     * @var string
     */
    protected $controllerName;


    /**
     * @param $controllerName
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     * @param object $item
     * @param object $transformer
     * @param array $parameters
     * @param Closure|null $after
     * @return \Dingo\Api\Http\Response
     */
    public function item($item, $transformer = null, $parameters = [], Closure $after = null)
    {
        $transformer = $transformer ?: $this->processTransformer();

        return parent::item($item, $transformer, $parameters, $after);
    }


    /**
     * @param Collection $collection
     * @param object $transformer
     * @param array $parameters
     * @param Closure|null $after
     * @return \Dingo\Api\Http\Response
     */
    public function collection(Collection $collection, $transformer = null, $parameters = [], Closure $after = null)
    {
        $transformer = $transformer ?: $this->processTransformer();

        return parent::collection($collection, $transformer, $parameters, $after);
    }

    /**
     * @param Paginator $paginator
     * @param object $transformer
     * @param array $parameters
     * @param Closure|null $after
     * @return \Dingo\Api\Http\Response
     */
    public function paginator(Paginator $paginator, $transformer = null, array $parameters = [], Closure $after = null)
    {
        $transformer = $transformer ?: $this->processTransformer();

        return parent::paginator($paginator, $transformer, $parameters, $after);
    }

    /**
     * @return \App\Lib\Transformer\BaseTransformer
     */
    protected function processTransformer()
    {
        $appNamespace = $this->getAppNamespace();
        $transformerName = str_replace('Controller', '', $this->controllerName);
        $transformerClass = $appNamespace . 'Controllers\\Transformers\\' . $transformerName . 'Transformer';

        if (!class_exists($transformerClass)) {
            $transformer = BaseTransformer::class;
        }

        return app($transformer);
    }

}