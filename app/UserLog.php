<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'diary',
    ];

    public function scopeSearch($query, $params)
    {
        if (($user_id = trim(array_get($params, 'user_id'))) !== '') {
            $query->where('user_id', $user_id);
        }

        return $query;
    }
}
