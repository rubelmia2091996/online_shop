<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SubCategory;
use App\Models\Product;

class catagory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['catagory_name','slug'];

    public function subCategory(){  
        return $this->hasMany(SubCategory::class,'catagories_id');
    }
    public function product(){  
        return $this->hasMany(Product::class,'catagories_id');
    }
}
