<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $table = 'materials';

    use HasFactory;

    protected $fillable =[
        'type_material'
    ];

    public function tooth()
    {
        return $this->hasMany(Tooth::class, 'material_id');
    }
}
