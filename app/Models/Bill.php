<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $table = 'bills';
    
    use HasFactory;
    
    protected $fillable = [
        'case_id',
        'is_paid',
        'price',
        'total_price'
    ];

    public function case()
    {
        return $this->hasOne(Cases::class,'case_id');
    }

}
