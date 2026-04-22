<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
  public function index(): JsonResponse
  {
    $roomTypes = RoomType::query()->get();

    return response()->json($roomTypes);
  }

  public function show(RoomType $roomType): JsonResponse
  {
    return response()->json($roomType);
  }

  public function store(Request $request): JsonResponse
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
    ]);

    $roomType = RoomType::query()->create($data);

    return response()->json($roomType, 201);
  }

  public function update(Request $request, RoomType $roomType): JsonResponse
  {
    $data = $request->validate([
      'name' => ['sometimes', 'required', 'string', 'max:255'],
    ]);

    $roomType->update($data);

    return response()->json($roomType);
  }

  public function destroy(RoomType $roomType): JsonResponse
  {
    $roomType->delete();

    return response()->json(null, 204);
  }
}
