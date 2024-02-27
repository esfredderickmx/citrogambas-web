<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  use HasFactory;

  protected $fillable = [
    'user_id',
    'promotion_id',
    'note',
    'type',
    'table_id',
    'status',
    'rating',
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function promotion() {
    return $this->belongsTo(Promotion::class);
  }

  public function dishes() {
    return $this->belongsToMany(Dish::class)->withPivot('quantity');
  }

  public function table() {
    return $this->belongsTo(Table::class);
  }
}
