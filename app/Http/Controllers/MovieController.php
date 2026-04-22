<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  public function index(): JsonResponse
  {
    $movies = Movie::query()->with(['classification', 'category', 'showtimes'])->get();

    return response()->json($movies);
  }

  public function show(Movie $movie): JsonResponse
  {
    $movie->load(['classification', 'category', 'showtimes']);

    return response()->json($movie);
  }

  public function store(Request $request): JsonResponse
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'synopsis' => ['required', 'string'],
      'classification_id' => ['required', 'integer', 'exists:classifications,id'],
      'category_id' => ['required', 'integer', 'exists:categories,id'],
      'duration' => ['required', 'integer', 'min:1'],
      'release_date' => ['required', 'date'],
    ]);

    $movie = Movie::query()->create($data);

    return response()->json($movie, 201);
  }

  public function update(Request $request, Movie $movie): JsonResponse
  {
    $data = $request->validate([
      'name' => ['sometimes', 'required', 'string', 'max:255'],
      'synopsis' => ['sometimes', 'required', 'string'],
      'classification_id' => ['sometimes', 'required', 'integer', 'exists:classifications,id'],
      'category_id' => ['sometimes', 'required', 'integer', 'exists:categories,id'],
      'duration' => ['sometimes', 'required', 'integer', 'min:1'],
      'release_date' => ['sometimes', 'required', 'date'],
    ]);

    $movie->update($data);

    return response()->json($movie);
  }

  public function destroy(Movie $movie): JsonResponse
  {
    $movie->delete();

    return response()->json(null, 204);
  }
}
