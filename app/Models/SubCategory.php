<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\catagory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['subcategory_name','slug'];
    public function catagory(){
        return $this->belongsTo(catagory::class,'catagories_id');
    }
}
