<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
  public function index(): JsonResponse
  {
    $rooms = Room::query()->with('roomType')->get();

    return response()->json($rooms);
  }

  public function show(Room $room): JsonResponse
  {
    $room->load('roomType');

    return response()->json($room);
  }

  public function store(Request $request): JsonResponse
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'room_type_id' => ['required', 'integer', 'exists:room_types,id'],
      'capacity' => ['required', 'integer', 'min:1'],
    ]);

    $room = Room::query()->create($data);

    return response()->json($room, 201);
  }

  public function update(Request $request, Room $room): JsonResponse
  {
    $data = $request->validate([
      'name' => ['sometimes', 'required', 'string', 'max:255'],
      'room_type_id' => ['sometimes', 'required', 'integer', 'exists:room_types,id'],
      'capacity' => ['sometimes', 'required', 'integer', 'min:1'],
    ]);

    $room->update($data);

    return response()->json($room);
  }

  public function destroy(Room $room): JsonResponse
  {
    $room->delete();

    return response()->json(null, 204);
  }
}
