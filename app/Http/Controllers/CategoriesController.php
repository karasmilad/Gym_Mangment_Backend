<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Categories;
use App\Services\CategoriesService;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected CategoriesService $categoryService;

    public function __construct(CategoriesService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        try
        {
            $categories = $this->categoryService->getAll();
            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'No Category found'
                ], 404);
            }
            return response()->json($categories, 200);
        }
        catch(Exception $e)
            {
                return response()->json([
                    'status'  => false,
                    'message' => $e->getMessage()
                ], 422);
            }
    }
    public function store(StoreCategoryRequest $request)
    {
        try
            {
                $category = $this->categoryService->createCategory($request->validated());
                return response()->json([
                    'status'  => true,
                    'message' => 'Category created successfully',
                    'data'    => $category
                ], 201);
            } 
        catch (Exception $e) 
            {
                return response()->json([
                    'status'  => false,
                    'message' => $e->getMessage()
                ], 422);
            }
    }
    public function show(int $id)
    {
        try
            {
                $category = $this->categoryService->getById($id);
                return response()->json([
                    'status'  => true,
                    'message' => 'Category found successfully',
                    'data'    => $category
                ], 200);
            }
        catch (Exception $e)
        {
            return response()->json([
                'status'=> false,
                'message'=> $e->getMessage()
                ], 404);
        }
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        try
            {
                $category = $this->categoryService->updateCategory($id, $request->validated());
                return response()->json([
                    'status'  => true,
                    'message' => 'Category updated successfully',
                    'data'    => $category
                ], 200);
            } 
        catch (Exception $e) {
                return response()->json([
                    'status'  => false,
                    'message' => $e->getMessage()
                ], 422);
            }
    }
    public function destroy(int $id)
    {
    try
        {
            $this->categoryService->delete($id);
            return response()->json([
                'status'  => true,
                'message' => 'Category Delete successfully'
            ], 200);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'=> false,
                'message'=> $e->getMessage()
                ], 404);
        }
    }
}
