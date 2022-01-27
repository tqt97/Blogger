<?php

namespace App\Models;

// use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['tagName',];
    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    //     'deleted_at'
    // ];
    // public function getCreatedAtAttribute($dates)
    // {
    //     return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dates)->format('Y-m-d');
    // }

    // public function getUpdatedAtAttribute($dates)
    // {
    //     return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dates)->format('Y-m-d');
    // }
}
