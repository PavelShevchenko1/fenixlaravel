<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FxAppUser extends Model
{
    use HasFactory;

    protected $primaryKey = 'session_id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'session_id',
        'gender',
        'birth_date',
        'fcm_token'
    ];
}
