<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailSalesHistory extends Model
{
    use HasFactory;

    protected $table = 'retail_sales_history';
    protected $guarded =[];
    protected $fillable = ['*'];
}
