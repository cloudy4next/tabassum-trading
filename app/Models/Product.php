<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $guarded = [];
    protected $fillable = ['id'];

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'product_id', 'id');
    }
}
