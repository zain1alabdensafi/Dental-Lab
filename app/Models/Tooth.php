<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tooth extends Model
{
    public $table = 'teeth';
    use HasFactory;
    protected $fillable = [
        'case_id',
        'treatment_id',
        'material_id',
        'tooth_number',
        'bridge',
    ];
    protected $casts = [
        'tooth_number' => 'array',
    ];
    
    public function case()
    {
        return $this->belongsTo(Cases::class);
    }
    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    
}
