<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    public static function formatDateTimeToIndoDateTime($dateTime) {
        if ($dateTime == "" || $dateTime == null) return "-";
        return Carbon::parse($dateTime)->isoFormat('D MMM Y  HH:mm');
    }

    public static function formatDateToIndoDate($date) {
        if ($date == "" || $date == null) return "-";
        return Carbon::parse($date)->isoFormat('D MMM Y');
    }
}
