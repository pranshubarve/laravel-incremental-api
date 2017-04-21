<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Models\Category;
use App\Phoenix\Transformers\CategoryTransformer;
// use Illuminate\Http\Request;
use Response;
use Log;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api
 */
class CategoryController extends ApiController
{
    /**
     * @var CategoryTransformer
     */
    protected $categoryTransformer;

    /**
     * CategoryController constructor.
     * @param CategoryTransformer $categoryTransformer
     */
    public function __construct(CategoryTransformer $categoryTransformer)
    {
        $this->categoryTransformer = $categoryTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return $this->respond(['data' => $this->categoryTransformer->transformCollection($category->all())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->respondNotFound('Method Not Exists!');
    }

    /**
     * Store Category
     *
     * @param CategoryStore $request
     * @return mixed
     */
    public function store(CategoryStore $request)
    {
        try {
            $category = Category::create($this->makeSaveArray($request));
            return $this->respondCreated('Category successfully created.', $this->categoryTransformer->transform($category));
        } catch (\Exception $e) {
            \Log::info($e);
            return $this->respondInternalError('Internal Server Error!');
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function makeSaveArray($request)
    {
        return $requests = [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return $this->respondNotFound('Category does not exist.');
        }
        return $this->respond(['data' => $this->categoryTransformer->transform($category)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->respondNotFound('Method Not Exists!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdate $request
     * @param $id
     */
    public function update(CategoryUpdate $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
