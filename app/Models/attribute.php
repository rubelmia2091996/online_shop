<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\color;
use App\Models\size;
use Illuminate\Database\Eloquent\SoftDeletes;

class attribute extends Model
{
    use HasFactory,SoftDeletes;
    public function Product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function color(){
        return $this->belongsTo(color::class,'color_id');
    }
    public function size(){
        return $this->belongsTo(size::class,'size_id');
    }
}
