<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
  protected $fillable = [
    'name',
    'room_type_id',
    'capacity',
  ];

  protected $casts = [
    'capacity' => 'integer',
  ];

  public function roomType(): BelongsTo
  {
    return $this->belongsTo(RoomType::class);
  }

  public function showtimes(): HasMany
  {
    return $this->hasMany(Showtime::class);
  }
}
