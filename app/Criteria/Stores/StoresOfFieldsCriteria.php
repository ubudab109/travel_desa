<?php

namespace App\Criteria\Stores;


use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class StoresOfFieldsCriteria.
 *
 * @package namespace App\Criteria\Stores;
 */
class StoresOfFieldsCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * StoresOfFieldsCriteria constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if(!$this->request->has('fields')) {
            return $model;
        } else {
            $fields = $this->request->get('fields');
            if (in_array('0',$fields)) {
                return $model;
            }
            return $model->join('store_fields', 'store_fields.store_id', '=', 'stores.id')
                ->whereIn('store_fields.field_id', $this->request->get('fields'))->groupBy('stores.id');
        }
    }
}
