<?php

namespace Laraecart\Ecommerce\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Laraecart\Ecommerce\Interfaces\ProductRepositoryInterface;

class ProductPublicController extends BaseController
{
    // use ProductWorkflow;

    /**
     * Constructor.
     *
     * @param type \Laraecart\Product\Interfaces\ProductRepositoryInterface $product
     *
     * @return type
     */
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->repository = $product;
        parent::__construct();
    }

    /**
     * Show product's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $products = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();


        return $this->response->title(trans('$ecommerce::$product.names'))
            ->view('$ecommerce::public.product.index')
            ->data(compact('$products'))
            ->output();
    }

    /**
     * Show product's list based on a type.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function list($type = null)
    {
        $products = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();


        return $this->response->title(trans('$ecommerce::$product.names'))
            ->view('$ecommerce::public.product.index')
            ->data(compact('$products'))
            ->output();
    }

    /**
     * Show product.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $product = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->response->title($$product->name . trans('$ecommerce::$product.name'))
            ->view('$ecommerce::public.product.show')
            ->data(compact('$product'))
            ->output();
    }

}
