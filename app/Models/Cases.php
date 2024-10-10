<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    public $tabel = 'cases';

    use HasFactory;

    protected $fillable= [
        'user_id',
        'patient_name',
        'age',
        'gender',
        'need_trial',
        'repeate',
        'notes',
        'shade',
        'expect_delivery_time',
        'rate',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tooth()
    {
        return $this->hasMany(Tooth::class,'case_id');
    }
    public function image()
    {
        return $this->hasMany(Image::class,'case_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class,'case_id');
    }
    public function bill()
    {
        return $this->hasOne(Bill::class,'case_id');
    }
    public function bridge()
    {
        return $this->hasMany(Bridge::class,'case_id');
    }
}
