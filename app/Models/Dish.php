<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model {
  use HasFactory;

  protected $fillable = [
    'name',
    'image',
    'description',
    'price',
    'audience',
    'season',
  ];

  public function categories() {
    return $this->belongsToMany(Category::class);
  }

  public function orders() {
    return $this->belongsToMany(Order::class)->withPivot('quantity');
  }
}
