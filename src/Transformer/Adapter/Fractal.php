<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/8
 */

namespace Koala\Lib\Transformer\Adapter;

use App\Lib\Transformer\Serializer\NoDataArraySerializer;
use Dingo\Api\Transformer\Adapter\Fractal as DingoFractal;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Serializer\SerializerAbstract;

class Fractal extends DingoFractal
{

    /**
     * Fractal constructor.
     * @param FractalManager $fractal
     * @param string $includeKey
     * @param string $includeSeparator
     * @param bool $eagerLoading
     */
    public function __construct(FractalManager $fractal, $includeKey = 'include', $includeSeparator = ',', $eagerLoading = true)
    {
        parent::__construct($fractal, $includeKey, $includeSeparator, $eagerLoading);
        $this->setupSerializer();
    }


    /**
     * @return $this
     */
    protected function setupSerializer()
    {
        $serializer = $this->serializer();

        if ($serializer instanceof SerializerAbstract) {
            $this->fractal->setSerializer(new $serializer());
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function serializer()
    {
        $serializer = config('repository.fractal.serializer', NoDataArraySerializer::class);

        return new $serializer();
    }

}