<?php

namespace App\Criteria\Products;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TrendingWeekCriteria.
 *
 * @package namespace App\Criteria\Products;
 */
class TrendingWeekCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * TrendingWeekCriteria constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {

            return $model->join('product_orders', 'products.id', '=', 'product_orders.product_id')
                ->whereBetween('product_orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('products.id')
                ->orderBy('product_count','desc')
                ->select('products.*', DB::raw('count(products.id) as product_count'));

    }
}
