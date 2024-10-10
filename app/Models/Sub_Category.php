<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    use HasFactory;
    public $table = 'subcategories';
    protected $fillable  = [
        'category_id',
        'name'
    ];
public function category (){
    return $this->belongsTo(Category::class);
}
public function items (){
    return $this->hasMany(item::class,'subcategory_id');
}
}
