<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
  public function index(): JsonResponse
  {
    $showtimes = Showtime::query()->with(['movie', 'room'])->get();

    return response()->json($showtimes);
  }

  public function show(Showtime $showtime): JsonResponse
  {
    $showtime->load(['movie', 'room']);

    return response()->json($showtime);
  }

  public function store(Request $request): JsonResponse
  {
    $data = $request->validate([
      'movie_id' => ['required', 'integer', 'exists:movies,id'],
      'room_id' => ['required', 'integer', 'exists:rooms,id'],
    ]);

    $showtime = Showtime::query()->create($data);

    return response()->json($showtime, 201);
  }

  public function update(Request $request, Showtime $showtime): JsonResponse
  {
    $data = $request->validate([
      'movie_id' => ['sometimes', 'required', 'integer', 'exists:movies,id'],
      'room_id' => ['sometimes', 'required', 'integer', 'exists:rooms,id'],
    ]);

    $showtime->update($data);

    return response()->json($showtime);
  }

  public function destroy(Showtime $showtime): JsonResponse
  {
    $showtime->delete();

    return response()->json(null, 204);
  }
}
