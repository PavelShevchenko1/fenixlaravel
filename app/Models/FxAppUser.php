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

    protected $appends = ['barcode', 'topics'];

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

    public function getBarcodeAttribute()
    {
        try {
            $birthDate = new \DateTime($this->attributes['birth_date']);
            $currentDate = new \DateTime();
            $age = $currentDate->diff($birthDate)->y;
            $ageGroup = FxAppUserGroup::where('age_from', '<=', $age)
                ->where('age_to', '>=', $age)
                ->first();
            return optional($ageGroup)->barcode;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getTopicsAttribute()
    {
        $availableTopics = [];

        switch ($this->gender) {
            case 'male':
                $availableTopics[] = 'all_male';
                switch ($this->platform) {
                    case 'android':
                        $availableTopics[] = 'all_android';
                        $availableTopics[] = 'male_android';
                        break;
                    case 'ios':
                        $availableTopics[] = 'all_ios';
                        $availableTopics[] = 'male_ios';
                        break;
                }
                break;

            case 'female':
                $availableTopics[] = 'all_female';
                switch ($this->platform) {
                    case 'android':
                        $availableTopics[] = 'all_android';
                        $availableTopics[] = 'female_android';
                        break;
                    case 'ios':
                        $availableTopics[] = 'all_ios';
                        $availableTopics[] = 'female_ios';
                        break;
                }
                break;
        }

        return $availableTopics;
    }


    public static $all_topics = array(
        'all_android',
        'all_ios',
        'all_male',
        'all_female',
        'male_android',
        'female_android',
        'male_ios',
        'female_ios'
    );
}
