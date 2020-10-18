<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Laravel\Lumen\Routing\Controller as BaseController;

class APIController extends BaseController
{
    protected $page_size = 100;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if (isset(static::$responseBuilder)) {
            return call_user_func(static::$responseBuilder, $request, $errors);
        }
        return new JsonResponse($errors, 400);
    }

    protected function filter(Request $request, $eloquent, $collection = null)
    {
        $operators = [
            'eq' => '=', 'contains' => 'like',
            'gt' => '>', 'gte' => '>=',
            'lt' => '<', 'lte' => '<='
        ];
        if (!$collection) {
            $collection = $eloquent::whereRaw('1 = 1');
        }
        $query = $request->query();
        foreach ($query as $key => $value) {
            if (strpos($key, '__') !== false) {
                list($key, $op) = explode('__', $key);
            }
            else {
                $op = 'eq';
            }
            if (in_array($key, $eloquent::$minified)) {
                if (in_array($op, array_keys($operators))) {
                    if ($op == 'contains') {
                        $value = '%'.$value.'%';
                    }
                    $collection = $collection->where($key, $operators[$op], $value);
                }
            }
        }
        return $collection;
    }

    protected function paginate(Request $request, $collection, $defaultSortColumn='id')
    {
        $page = $request->query('page');
        $sort = $request->query('sort') ? $request->query('sort') : $defaultSortColumn;
        if (strpos($sort, '__') !== false) {
            list($sortColumn, $sortOrder) = explode('__', $sort);
        }
        else {
            $sortColumn = $sort;
            $sortOrder = 'desc';
        }
        $collection->orderBy($sortColumn, $sortOrder);
        if (is_numeric($page)) {
            $offset = $page - 1;
            if ($offset > 0) {
                return $collection->skip($this->page_size * $offset)->take($this->page_size);
            }
        }
        return $collection->skip(0)->take($this->page_size);
    }

    protected function pagination_info(Request $request, $collection)
    {
        $urls = [];
        $query = $request->query();
        $path = $request->getPathInfo();
        $path = substr($path, 0, strpos($path, 'pagination'));
        $count = $collection->count();
        $num_pages = ceil($count / $this->page_size);
        for ($i=0; $i<$num_pages; $i++) {
            $query['page'] = $i + 1;
            $urls[] = URL::to($path).'/?'.http_build_query($query);
        }
        return [
            'count' => $count,
            'page_size' => $this->page_size,
            'num_pages' => $num_pages,
            'urls' => $urls
        ];
    }
}
