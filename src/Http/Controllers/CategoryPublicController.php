<?php

namespace Laraecart\Ecommerce\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Laraecart\Ecommerce\Interfaces\CategoryRepositoryInterface;

class CategoryPublicController extends BaseController
{
    // use CategoryWorkflow;

    /**
     * Constructor.
     *
     * @param type \Laraecart\Category\Interfaces\CategoryRepositoryInterface $category
     *
     * @return type
     */
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->repository = $category;
        parent::__construct();
    }

    /**
     * Show category's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $categories = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();


        return $this->response->title(trans('$ecommerce::$category.names'))
            ->view('$ecommerce::public.category.index')
            ->data(compact('$categories'))
            ->output();
    }

    /**
     * Show category's list based on a type.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function list($type = null)
    {
        $categories = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();


        return $this->response->title(trans('$ecommerce::$category.names'))
            ->view('$ecommerce::public.category.index')
            ->data(compact('$categories'))
            ->output();
    }

    /**
     * Show category.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $category = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->response->title($$category->name . trans('$ecommerce::$category.name'))
            ->view('$ecommerce::public.category.show')
            ->data(compact('$category'))
            ->output();
    }

}
