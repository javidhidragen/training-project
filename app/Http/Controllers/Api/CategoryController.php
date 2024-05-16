<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Category;
use Illuminate\Http\Request;
use App\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;

class CategoryController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return $this->successResponse($categories, 'Categories retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', Rule::unique('categories')->ignore($request->name)],
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->errorResponse('Invalid data', 422, $validator->errors());
        }

        $category = Category::create($request->all());

        return $this->successResponse($category, 'Category saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', Rule::unique('categories')->ignore($id)],
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->errorResponse('Invalid data', 422, $validator->errors());
        }

        Category::findOrFail($id)->update($request->all()); 

        return $this->successResponse([], 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $category = Category::findOrFail($id)->update($request->all());

        return $this->successResponse($category, 'Category deleted successfully');
    }
}
