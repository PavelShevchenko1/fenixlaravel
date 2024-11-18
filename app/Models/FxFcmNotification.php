<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FxFcmNotification extends Model
{
    use HasFactory;

    protected $appends = ['topic'];

    protected $fillable = [
        'title',
        'body',
        'image',
        'to_all',
        'to_age',
        'to_gender',
        'to_platform',
    ];

    public function getTopicAttribute()
    {
        $topic = 'all';
        if ($this->is_all == 1) {
            $topic = 'all';
            return $topic;
        }
        $genders = array('male', 'female');
        $platforms = array('android', 'ios');
        if ($this->to_gender && in_array($this->to_gender, $genders)) {
            if ($this->to_platform &&  in_array($this->to_platform, $platforms)) {
                switch ($this->to_gender) {
                    case 'male':
                        switch ($this->to_platform) {
                            case 'android':
                                return 'male_android';
                            case 'ios':
                                return 'male_ios';

                            default:
                                return 'all_male';
                        }
                    case 'female':
                        switch ($this->to_platform) {
                            case 'android':
                                return 'female_android';
                            case 'ios':
                                return 'female_ios';

                            default:
                                return 'all_ios';
                        }
                    default:
                        return 'all';
                }
            } else {
                switch ($this->to_gender) {
                    case 'male':
                        return 'all_male';
                    case 'female':
                        return 'all_female';
                    default:
                        return $topic;
                }
            }
        }
        return $topic;
    }


    public function attempts()
    {
        return $this->hasMany(
            FxFcmNotificationAttempt::class,
            'notification_id'
        );
    }
}
