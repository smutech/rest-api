<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(20);

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name');
        $rules = ['name' => 'required|unique:App\Models\Category,name'];
        $messages = [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name already exists.'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()], 400);
        }

        $category = Category::create([
            'name' => $request->name,
        ]);

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response(['error' => 'Invalid ID'], 404);
        }

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response(['error' => 'Invalid ID'], 404);
        }

        $data = $request->only('name');
        $rules = [
            'name' => 'required',
            Rule::unique('App\Models\Category')->ignore($category->name, 'name')
        ];
        $messages = [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name already exists.'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()], 400);
        }

        $category->update([
            'name' => $request->name,
        ]);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response(['error' => 'Invalid ID'], 404);
        }

        $category->delete();

        return response(null, 204);
    }
}
