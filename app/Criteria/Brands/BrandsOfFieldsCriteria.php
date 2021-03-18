<?php

namespace App\Criteria\Brands;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class BrandsOfFieldsCriteria.
 *
 * @package namespace App\Criteria\Brands;
 */
class BrandsOfFieldsCriteria implements CriteriaInterface
{

    /**
     * @var array
     */
    private $request;

    /**
     * BrandsOfFieldsCriteria constructor.
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
        if (!$this->request->has('fields')) {
            return $model;
        } else {
            $fields = $this->request->get('fields');
            if (in_array('0', $fields)) { // means all fields
                return $model;
            }
            return $model->join('products','products.brand_id','=','brands.id')
                ->join('store_fields', 'store_fields.store_id', '=', 'products.store_id')
                ->whereIn('store_fields.field_id', $this->request->get('fields',[]))->select('brands.*')->groupBy('brands.id');
        }
    }
}
