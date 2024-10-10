<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bridge extends Model
{
    public $table='bridges';

    use HasFactory;
    protected $fillable =[
        'case_id',
        'teeth_number'
    ];
    protected $casts=[
        'teeth_number'=>'array'
    ];
    public function case()
    {
        return $this->belongsTo(Cases::class);
    }
}
