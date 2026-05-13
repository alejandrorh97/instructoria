<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'synopsis',
    'classification_id',
    'category_id',
    'duration',
    'release_date',
  ];

  protected $casts = [
    'duration' => 'integer',
    'release_date' => 'date',
  ];

  public function classification(): BelongsTo
  {
    return $this->belongsTo(Classification::class);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function showtimes(): HasMany
  {
    return $this->hasMany(Showtime::class);
  }
}
