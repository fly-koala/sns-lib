<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/9
 */

namespace Koala\Lib\Repository\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

abstract class BaseCriteria implements CriteriaInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function processVirtualFields($model, RepositoryInterface $repository, $case = null)
    {
        return $model;
    }
}