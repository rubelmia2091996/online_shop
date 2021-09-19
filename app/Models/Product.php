<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\catagory;
use App\Models\SubCategory;
use App\Models\attribute;
use App\Models\gallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    public function catagory(){
        return $this->belongsTo(catagory::class,'category_id');
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'subCategory_id');
    }
    public function attribute(){
        return $this->hasMany(attribute::class,'product_id');
    }
    public function gallery(){
        return $this->hasMany(gallery::class,'product_id');
    }
}
