<?php

namespace Laraecart\Ecommerce\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class ProductResourceCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model
                        ->where('user_id','=', user_id())
                        ->where('user_type','=', user_type());
        return $model;
    }
}