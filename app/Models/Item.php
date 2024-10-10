<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $table = 'items';
    protected $fillable = [
        'subcategory_id',
        'name',
        'quantity'
    ];

 public function subcategory (){
    return $this->Belongsto(Sub_Category::class);
 }
}
