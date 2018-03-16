<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/8
 */

namespace Koala\Lib\Traits;

use Koala\Lib\Response\Factory;
use Dingo\Api\Routing\Helpers as DingoHelpers;

/**
 * Trait Helpers
 * @package App\Lib\Traits
 */
trait Helpers
{
    use DingoHelpers;

    /**
     * @return \App\Lib\Response\Factory
     */
    public function response()
    {
        /* @var \App\Lib\Response\Factory $factory */
        $factory = app(Factory::class);
        $controllerName = class_basename($this);
        $factory->setControllerName($controllerName);

        return $factory;
    }

}