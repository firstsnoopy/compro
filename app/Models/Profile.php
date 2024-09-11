<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'picture',
        'nama_lengkap',
        'alamat',
        'no_telpon',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'description',
        'status'
    ];
}
