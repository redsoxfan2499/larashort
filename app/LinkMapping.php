<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DB;

class LinkMapping extends Model
{
    protected $fillable = [
        'custom_slug',
        'code',
        'redirect_url',
        'shortened_url',
        'requested_count',
        'last_requested_date'
    ];

    protected $dates = [
        'last_requested_date'
    ];

    public static function saveLinkStat($find_redirect_url)
    {
        DB::table('link_mappings')
            ->where('id', $find_redirect_url[0]->id)
            ->update([
                'requested_count' => $find_redirect_url[0]->requested_count + 1,
                'last_requested_date' => Carbon::now()
            ]);
    }

}
