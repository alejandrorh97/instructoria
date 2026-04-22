<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
  public function index(): JsonResponse
  {
    $classifications = Classification::query()->get();

    return response()->json($classifications);
  }

  public function show(Classification $classification): JsonResponse
  {
    return response()->json($classification);
  }

  public function store(Request $request): JsonResponse
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
    ]);

    $classification = Classification::query()->create($data);

    return response()->json($classification, 201);
  }

  public function update(Request $request, Classification $classification): JsonResponse
  {
    $data = $request->validate([
      'name' => ['sometimes', 'required', 'string', 'max:255'],
    ]);

    $classification->update($data);

    return response()->json($classification);
  }

  public function destroy(Classification $classification): JsonResponse
  {
    $classification->delete();

    return response()->json(null, 204);
  }
}
