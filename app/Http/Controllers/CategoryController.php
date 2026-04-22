<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index(): JsonResponse
  {
    $categories = Category::query()->get();

    return response()->json($categories);
  }

  public function show(Category $category): JsonResponse
  {
    return response()->json($category);
  }

  public function store(Request $request): JsonResponse
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
    ]);

    $category = Category::query()->create($data);

    return response()->json($category, 201);
  }

  public function update(Request $request, Category $category): JsonResponse
  {
    $data = $request->validate([
      'name' => ['sometimes', 'required', 'string', 'max:255'],
    ]);

    $category->update($data);

    return response()->json($category);
  }

  public function destroy(Category $category): JsonResponse
  {
    $category->delete();

    return response()->json(null, 204);
  }
}
