<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'images';
    use HasFactory;
    protected $fillable = [
        'case_id',
        'image'
    ];
    protected $casts=[
        'image'=>'array'
    ];
    public function case()
    {
        return $this->belongsTo(Cases::class);
    }
}
