<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/9
 */

namespace Koala\Lib\Repository;

use Koala\Lib\Repository\Criteria\AdvancedSearchCriteria;
use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;
use Prettus\Repository\Traits\CacheableRepository;

abstract class BaseRepository extends PrettusRepository
{
    protected $cacheSkip = false;

    use CacheableRepository;

    /**
     * 虚拟字段
     * @var array
     */
    protected $virtualFields = [];

    /**
     * @return array
     */
    public function getVirtualFields(): array
    {
        return $this->virtualFields;
    }


    /**
     * @param array $virtualFields
     */
    public function setVirtualFields(array $virtualFields)
    {
        $this->virtualFields = $virtualFields;
    }


    public function getAdvancedSearchModel()
    {
        $this->pushCriteria(app(AdvancedSearchCriteria::class));

        return $this;
    }
}