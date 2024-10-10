<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table ='comments';
    use HasFactory;
    protected $fillable =[
        'case_id',
        'comment'
    ];
    public function case()
    {
        return $this->belongsTo(Cases::class);
    }

}
