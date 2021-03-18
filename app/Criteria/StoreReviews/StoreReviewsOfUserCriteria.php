<?php

namespace App\Criteria\StoreReviews;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class StoreReviewsOfUserCriteria.
 *
 * @package namespace App\Criteria\StoreReviews;
 */
class StoreReviewsOfUserCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $userId;

    /**
     * StoreReviewsOfUserCriteria constructor.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
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
        if (auth()->user()->hasRole('admin')) {
            return $model->select('store_reviews.*');
        } else if (auth()->user()->hasRole('manager')) {
            return $model->join("user_stores", "user_stores.store_id", "=", "store_reviews.store_id")
                ->where('user_stores.user_id', $this->userId)
                ->groupBy('store_reviews.id')
                ->select('store_reviews.*');
        } else if (auth()->user()->hasRole('driver')) {
            return $model->join("driver_stores", "driver_stores.store_id", "=", "store_reviews.store_id")
                ->where('driver_stores.user_id', $this->userId)
                ->groupBy('store_reviews.id')
                ->select('store_reviews.*');
        } else if (auth()->user()->hasRole('client')) {
            return $model->where('store_reviews.user_id', $this->userId)
                ->groupBy('store_reviews.id')
                ->select('store_reviews.*');
        }
    }
}
