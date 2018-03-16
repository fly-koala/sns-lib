<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/7
 */

namespace App\Lib\Services;

use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BaseService
 * @package App\Lib\Services
 */
abstract class BaseService
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    protected $client;

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->repository->all($columns);
    }
}