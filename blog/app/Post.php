<?php

namespace App;

use Carbon\Carbon;
use Couchbase\UserSettings;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function addComment()
    {
        $this->comments()->create(
            [
                'user_id' => auth()->id(),
                'body' => request('body')

            ]
        );
    }


// wrong method, I think
    public function scopeFilter($query, $filters)
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        if (!empty($filters)
            && array_key_exists('month', $filters)
            && array_key_exists('year', $filters)
            && count(array_intersect($filters, $months)) > 0
            && is_int((int) $filters['year'])){
            $query->whereMonth('created_at', Carbon::parse($filters['month'])->month);
            $query->whereYear('created_at', $filters['year']);
        }
    }


    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }


}
