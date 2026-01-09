<?php

namespace App\Services;

use App\Models\Categories;
use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriesService
{
    public function getAll()
    {
        try {
            return Categories::latest()->get();
        } catch (Exception $e) {
            throw new Exception('Failed to fetch categories : ' . $e->getMessage());
        }
    }
    public function getById(int $id)
    {
        try {
            return Categories::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Failed to fetch category : ' . $e->getMessage());
        }
    }
    public function createCategory(array $data)
    {
        try {
            return Categories::create($data);
        } catch (Exception $e) {
            throw new Exception('Failed to create category : ' . $e->getMessage());
        }
    }
    public function updateCategory(int $id, array $data)
    {
        try {
            $category = Categories::findOrFail($id);
            $category->update($data);
            return $category;
        } catch (Exception $e) {
            throw new Exception('Failed to update category : ' . $e->getMessage());
        }
    }
    public function delete(int $id): bool
    {
        try {
            $category = Categories::findOrFail($id);
            return $category->delete();
        } catch (Exception $e) {
            throw new Exception('Failed to delete category : ' . $e->getMessage());
        }
    }
}