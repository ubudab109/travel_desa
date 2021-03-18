<?php

namespace App\Repositories;

use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
 */
class ProductRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'discount_price',
        'description',
        'capacity',
        'package_items_count',
        'unit',
        'itemsAvailable',
        'featured',
        'store_id',
        'category_id',
        'brand_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    /**
     * get my products
     **/
    public function myProducts()
    {
        return Product::join("user_stores", "user_stores.store_id", "=", "products.store_id")
            ->where('user_stores.user_id', auth()->id())->get();
    }

    public function groupedByStores()
    {
        $products = [];
        foreach ($this->all() as $model) {
            $products[$model->store->name][$model->id] = $model->name;
        }
        return $products;
    }
}
