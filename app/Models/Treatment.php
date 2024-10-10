<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public $table = 'treatments';
    use HasFactory;
    protected $fillabel = [
        'type_treatment'
    ];
    public function tooth()
    {
        return $this->hasMany(Tooth::class,'treatment_id');
    }
}
