<?php
use App\Services\SettingService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Helper
{
    public static function pagination($current_page, $total_pages, $total_link, $per_page, $offset){
        function processParam($url, $paramName, $paramValue) {
            if (empty($paramName) || empty($paramValue)) {
                return $url;
            }
        
            $paramValue = urlencode($paramValue);
            $url = preg_replace('/(?<=[' . preg_quote('?&') . '])' . preg_quote($paramName) . '=[^&]+/u', $paramName . '=' . $paramValue, $url, 1, $count);
        
            if ($count === 0) {
                $separator = strpos($url, '?') !== false ? '&' : '?';
                $url .= $separator . $paramName . '=' . $paramValue;
            }
        
            return $url;
        }
        $rsHtml = '<div class="dataTable-pagination">';
        $rsHtml .= '<a class="page-item">' . ($offset + 1) . '-' . ($per_page + $offset < $total_link ? $per_page + $offset : $total_link) . '/' . $total_link . '</a>';

        $requestUri = $_SERVER['REQUEST_URI'];
        if ($current_page > 2) {
            $prev_page = $current_page - 1;
            $rsHtml .= '<a class="page-item" href="' . processParam($requestUri, 'page', $prev_page) . '">Prev</a>';
        }

        if ($current_page > 3) {
            $first_page = 1;
            $rsHtml .= '<a class="page-item" href="' . processParam($requestUri, 'page', $first_page) . '">' . $first_page . '</a>';

            if ($current_page > 4) {
                $rsHtml .= '<a class="page-item">...</a>';
            }
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i != $current_page) {
                if ($i > $current_page - 3 && $i < $current_page + 3) {
                    $rsHtml .= '<a class="phan-trang" href="' . processParam($requestUri, 'page', $i) . '">' . $i . '</a>';
                }
            } else {
                $rsHtml .= '<a class="phan-trang-fill">' . $i . '</a>';
            }
        }

        if ($current_page < $total_pages - 2) {
            $end_page = $total_pages;

            if ($current_page < $total_pages - 3) {
                $rsHtml .= '<a class="page-item">...</a>';
            }

            $rsHtml .= '<a class="page-item" href="' . processParam($requestUri, 'page', $end_page) . '">' . $end_page . '</a>';
        }

        if ($current_page < $total_pages - 1) {
            $next_page = $current_page + 1;
            $rsHtml .= '<a class="page-item" href="' . processParam($requestUri, 'page', $next_page) . '">Next</a>';
        }

        $rsHtml .= '</div>';
        return $rsHtml;
    }
}

if (!function_exists('round_views')) {
    function round_views($views)
    {
        if ($views >= 1000000000) {
            return number_format($views / 1000000000, 1) . 'T';
        } elseif ($views >= 1000000) {
            return number_format($views / 1000000, 1) . 'TR';
        } elseif ($views >= 1000) {
            return number_format($views / 1000, 1) . 'N';
        } else {
            return (string)$views;
        }
    }
}

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return app(SettingService::class)->get($key, $default);
    }
}
if (!function_exists('convertChartData')) {
    function convertChartData($dataChart, $startDate, $endDate)
    {
        $lables = daysBetweenMonths($startDate, $endDate);

        $data['revenue'] = [];
        $data['visits'] = [];
        $data['cpm']= [];

        foreach ($lables as $key=>$val) {
            $_data = $dataChart->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data['revenue'][] = round($revenue, 3);
            $data['visits'][] = (int)$visits;
            $data['cpm'][] = round($cpm, 3);
        }

        return [
            'labels' => $lables,
            'data' => $data
        ];
    }
}
if (!function_exists('convertChartStats')) {
    function convertChartStats($STUStats, $NOTEStats, $startDate, $endDate)
    {
        $merged = $STUStats->concat($NOTEStats)
        ->groupBy('date')
        ->map(function($items, $date) {
            return (object) [
                'date' => $date,
                'clicks' => $items->sum('clicks'),
                'revenue' => $items->sum('revenue'),
            ];
        })->values();

        $lables = daysBetweenMonths($startDate, $endDate);

        $data['revenue'] = [];
        $data['visits'] = [];
        $data['cpm']= [];

        foreach ($lables as $key=>$val) {
            $_data = $STUStats->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data['revenue']['STU'][] = round($revenue, 3);
            $data['visits']['STU'][] = (int)$visits;
            $data['cpm']['STU'][] = round($cpm, 3);
        }
        foreach ($lables as $key=>$val) {
            $_data = $NOTEStats->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data['revenue']['NOTE'][] = round($revenue, 3);
            $data['visits']['NOTE'][] = (int)$visits;
            $data['cpm']['NOTE'][] = round($cpm, 3);
        }

        return [
            'labels' => $lables,
            'data' => $data
        ];
    }
}
if (!function_exists('convertPaginData')) {
    function convertPaginData($dataChart, $startDate, $endDate)
    {
        $lables = daysBetweenMonths($startDate, $endDate);


        foreach ($lables as $key=>$val) {
            $_data = $dataChart->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data[] = [
                'date' => $val,
                'revenue' => round($revenue, 3),
                'views' => (int)$visits,
                'cpm' => round($cpm, 3)
            ];
        
        }
        return $data;
    }
}
if (!function_exists('convertChartAccess')) {
    function convertChartAccess($dataChart)
    {
        dd($dataChart);

    }
}
if (!function_exists('calcDaysBetween')) {
    function calcDaysBetween($startDate, $endDate): int
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        return $start->diffInDays($end);
    }
}
if (!function_exists('daysBetweenMonths')) {
    function daysBetweenMonths(string $startDate, string $endDate, string $dateFormat='Y-m-d'): array
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        if ($start->gt($end)) {
            throw new InvalidArgumentException('Invalid date range: start date must be less than or equal to end date');
        }
        
        $carbonDays = [];
        
        for ($date = $start; $date->lte($end); $date->addDay()) {
            $carbonDays[] = $date->format($dateFormat);
        }
        
        return $carbonDays;
    }
}

if (!function_exists('generateUniqueIdentifier')) {
    function generateUniqueIdentifier($request)
    {    
        $agent = $request->header('User-Agent');
        $accept = $request->header('Accept');
        $acceptLanguage = $request->header('Accept-Language');
        $acceptLanguage = $request->header('Accept-Encoding');

        $identifierString = $agent . $accept . $acceptLanguage . $acceptLanguage;
        $uniqueIdentifier = md5($identifierString);

        return $uniqueIdentifier;
    }
    if (!function_exists('generate_random_ip')) {
        function generate_random_ip($ip_defaut = null) {
            return $ip_defaut ?? long2ip(rand(0, 4294967295));
        }
    }
}
?>