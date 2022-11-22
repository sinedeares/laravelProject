<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /*public function getCategory(){
        return Category::find($this->category_id);
    }*/

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public  function getPriceForCount(){
        if(!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
        //return $this->price * $count;
    }
}
