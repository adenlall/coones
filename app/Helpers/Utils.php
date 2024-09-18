<?php
use Carbon\Carbon;
use IntlDateFormatter;

if (!function_exists('getCurrentMonthInArabic')) {
    function getCurrentMonthInArabic()
    {
        $date = Carbon::now();
        $formatter = new IntlDateFormatter('ar_EG', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Africa/Cairo', IntlDateFormatter::GREGORIAN, 'MMMM');
        $monthNameInArabic = $formatter->format($date);
        return $monthNameInArabic;
    }
}

if (!function_exists('insertSizeBeforeExtension')) {
    function insertSizeBeforeExtension($url, $size = '768x512') {
        $url_parts = parse_url($url);
        $path = $url_parts['path'];
        $path_info = pathinfo($path);
        $basename = $path_info['filename'];
        $extension = isset($path_info['extension']) ? '.' . $path_info['extension'] : '';
        $new_filename = $basename . '-' . $size . $extension;
        $new_path = $path_info['dirname'] !== '.' ? $path_info['dirname'] . '/' . $new_filename : $new_filename;
        return (isset($url_parts['scheme']) ? $url_parts['scheme'] . '://' : '') .
            (isset($url_parts['host']) ? $url_parts['host'] : '') .
            (isset($url_parts['port']) ? ':' . $url_parts['port'] : '') .
            $new_path .
            (isset($url_parts['query']) ? '?' . $url_parts['query'] : '') .
            (isset($url_parts['fragment']) ? '#' . $url_parts['fragment'] : '');
    }
}

if (!function_exists('ParseDateIntoArabic')) {
    function ParseDateIntoArabic(string $datetime): string {
        try {
            $dateTime = new DateTime($datetime);
            $inputDate = (new DateTime($datetime))->setTime(0, 0, 0);
        } catch (Exception $e) {
            return 'تاريخ غير صالح'; // Invalid date
        }
        $currentDateTime = new DateTime();
        $currentDate = (new DateTime())->setTime(0, 0, 0);
        $interval = $currentDate->diff($inputDate);
        $daysDifference = $interval->days;
        $isPast = $currentDateTime > $dateTime;
        $days = [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ];
        $formattedDate = $dateTime->format('d-m-Y');
        if ($daysDifference == 0 && $currentDateTime->format('Y-m-d') == $dateTime->format('Y-m-d')) {
            return "اليوم - $formattedDate";
        }
        elseif ($daysDifference == 1 || ($daysDifference == 0 && $isPast)) {
            return ($isPast ? "أمس" : "غدًا") . " - $formattedDate";
        }
        elseif ($daysDifference == 2 || ($daysDifference == 1 && !$isPast)) {
            return ($isPast ? "قبل يومين" : "بعد يومين") . " - $formattedDate";
        }
        elseif ($daysDifference <= 7) {
            $actualDays = $isPast ? $daysDifference + 1 : $daysDifference;
            $daysWord = $actualDays > 3 && $actualDays <= 10 ? 'أيام' : 'يومًا';
            return ($isPast ? "قبل" : "بعد") . " {$actualDays} {$daysWord} - $formattedDate";
        }
        elseif ($daysDifference <= 14) {
            return ($isPast ? "قبل أسبوع" : "بعد أسبوع") . " - $formattedDate";
        }
        elseif ($daysDifference <= 28) {
            $weeks = floor($daysDifference / 7);
            $weeksWord = $weeks == 2 ? 'أسبوعين' : 'أسابيع';
            return ($isPast ? "قبل" : "بعد") . " {$weeks} {$weeksWord} - $formattedDate";
        }
        elseif ($interval->y == 0) {
            $months = $interval->m;
            if ($months == 1) {
                return ($isPast ? "قبل شهر" : "بعد شهر") . " - $formattedDate";
            } elseif ($months == 2) {
                return ($isPast ? "قبل شهرين" : "بعد شهرين") . " - $formattedDate";
            } else {
                $monthsWord = $months <= 10 ? 'أشهر' : 'شهرًا';
                return ($isPast ? "قبل" : "بعد") . " {$months} {$monthsWord} - $formattedDate";
            }
        }
        else {
            $years = $interval->y;
            if ($years == 1) {
                return ($isPast ? "قبل سنة" : "بعد سنة") . " - $formattedDate";
            } elseif ($years == 2) {
                return ($isPast ? "قبل سنتين" : "بعد سنتين") . " - $formattedDate";
            } else {
                $yearsWord = $years <= 10 ? 'سنوات' : 'سنة';
                return ($isPast ? "قبل" : "بعد") . " {$years} {$yearsWord} - $formattedDate";
            }
        }
        $dayName = $days[$dateTime->format('l')];
        return "$dayName $formattedDate";
    }
}