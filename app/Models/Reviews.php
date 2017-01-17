<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model implements ModuleInterface
{
    protected $table = 'reviews';

    protected $fillable = [

    ];

    public function tracksProvider($id)
    {
        $tracks['avg_quality'] = self::reviews($id)->avg('quality');
        $tracks['avg_speed'] = self::reviews($id)->avg('speed');
        $tracks['avg_support'] = self::reviews($id)->avg('support');
        $tracks['avg_rating'] = round(5*(((int)$tracks['avg_quality'] + (int)$tracks['avg_speed'] + (int)$tracks['avg_support'])/3/100));
        $tracks['reviews_count'] = self::reviews($id)->count('id');

        if((int)$tracks['avg_quality'] < 30) {
            $tracks['quality']['comment'] = 'Плохая связь, одни перебои';
            $tracks['quality']['class'] = 'bad_rate';
        }
        if((int)$tracks['avg_quality'] >= 30 AND (int)$tracks['avg_quality'] < 70) {
            $tracks['quality']['comment'] = 'Перебоев почти нет, сносная связь';
            $tracks['quality']['class'] = 'middle_rate';
        }
        if((int)$tracks['avg_quality'] >= 70) {
            $tracks['quality']['comment'] = 'Отличная связь, работает как часы';
            $tracks['quality']['class'] = 'good_rate';
        }

        if((int)$tracks['avg_speed'] < 30) {
            $tracks['speed']['comment'] = 'Ужасная скорсть, не соответствует тарифам';
            $tracks['speed']['class'] = 'bad_rate';
        }
        if((int)$tracks['avg_speed'] >= 30 AND (int)$tracks['avg_speed'] < 70) {
            $tracks['speed']['comment'] = 'Иногда подтормаживает';
            $tracks['speed']['class'] = 'middle_rate';
        }
        if((int)$tracks['avg_speed'] >= 70) {
            $tracks['speed']['comment'] = 'Хорошая скорость, соответствует тарифам';
            $tracks['speed']['class'] = 'good_rate';
        }

        if((int)$tracks['avg_support'] < 30) {
            $tracks['support']['comment'] = 'В техподдержке одни хамы';
            $tracks['support']['class'] = 'bad_rate';
        }
        if((int)$tracks['avg_support'] >= 30 AND (int)$tracks['avg_support'] < 70) {
            $tracks['support']['comment'] = 'Сложно дозвониться в техподдержку';
            $tracks['support']['class'] = 'middle_rate';
        }
        if((int)$tracks['avg_support'] >= 70) {
            $tracks['support']['comment'] = 'Техподдержка на уровне, отвечают, помогают';
            $tracks['support']['class'] = 'good_rate';
        }

        return $tracks;
    }

    public function scopeReviews($query, $provider_id)
    {
        return $query->where(['provider_id' => $provider_id, 'status' => 1]);
    }

    public function getAttributes()
    {
        return $this->fillable;
    }

}
