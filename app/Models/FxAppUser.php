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

    public function getBirthAttribute()
    {
        try {
            $date = new \DateTime($this->attributes['birth_date']);
            return $date->format('d M Y');
        } catch (\Exception $e) {
            return '-';
        }
    }

    public function getPolAttribute()
    {
        switch ($this->attributes['gender']) {
            case 'male':
                return 'Мужчина';
            case 'female':
                return 'Женщина';

            default:
                return '-';
        }
    }

    protected $fillable = [
        'session_id',
        'gender',
        'birth_date',
        'platform',
        'fcm_token'
    ];
}
