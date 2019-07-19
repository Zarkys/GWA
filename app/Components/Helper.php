<?php

namespace App\Components;

use App\Http\Models\Enums\ActiveMenu;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use \Validator;


class Helper
{

    public static function after($thiss, $inthat)
    {
        if (!is_bool(strpos($inthat, $thiss))) {
            return substr($inthat, strpos($inthat, $thiss) + strlen($thiss));
        }

        return 'false';
    }

    public static function sidebar($file)
    {
        return (require 'sidebar/' . $file . '.php');
    }

    public static function after_last($thiss, $inthat)
    {
        if (!is_bool(self::strrevpos($inthat, $thiss))) {
            return substr($inthat, self::strrevpos($inthat, $thiss) + strlen($thiss));
        }

        return 'false';
    }

    public static function before($thiss, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $thiss));
    }

    public static function before_last($thiss, $inthat)
    {
        return substr($inthat, 0, self::strrevpos($inthat, $thiss));
    }

    public static function between($thiss, $that, $inthat)
    {
        return self::before($that, self::after($thiss, $inthat));
    }

    public static function between_last($thiss, $that, $inthat)
    {
        return self::after_last($thiss, self::before_last($that, $inthat));
    }

    public static function array_column($array, $column_name)
    {
        return array_map(function ($element) use ($column_name) {
            return $element[$column_name];
        }, $array);
    }

    public static function strrevpos($instr, $needle)
    {
        $rev_pos = strpos(strrev($instr), strrev($needle));
        if ($rev_pos === false) {
            return false;
        } else {
            return strlen($instr) - $rev_pos - strlen($needle);
        }
    }

    public static function date($time_transform, $format_time = 'd-m H:i', $time_zone = 'America/Caracas', $tz = 'UTC')
    {
        $time_gmt = new \DateTime($time_transform, new \DateTimeZone($tz));
        $time_tz = new \DateTimeZone($time_zone);
        $time_current = $time_gmt->setTimezone($time_tz);

        return $time_current->format($format_time);
    }

    public static function to_utc($time_transform, $tz = 'America/Caracas', $format_time = 'Y-m-d H:i:s', $time_zone = 'UTC')
    {
        $time_gmt = new \DateTime($time_transform, new \DateTimeZone($tz));
        $time_tz = new \DateTimeZone($time_zone);
        $time_current = $time_gmt->setTimezone($time_tz);

        return $time_current->format($format_time);
    }

    public static function hasPermission($slugs)
    {
        $permissions = self::getPermissionUser(Auth::user()->permissions);

        foreach ($slugs AS $slugs_index => $slug) {
            if (isset($permissions[$slug])) {
                return true;
            }
        }

        return false;
    }

    public static function getPermissionUser($permissions_find)
    {
        $permissions = [];

        foreach ($permissions_find AS $permissions_index => $permission) {
            $permissions[$permission->slug] = $permission->slug;
        }

        return $permissions;
    }

    public static function array_object(array $array)
    {
        return json_decode(json_encode($array));
    }

    public static function json_object($string)
    {
        return json_decode($string);
    }

    public static function object_array($object)
    {
        return json_decode(json_encode($object), true);
    }

    public static function object_json($object)
    {
        return json_encode(self::object_array($object));
    }

    public static function s3_put($file, $name, array $options = [])
    {
        $opt = self::array_object(array_merge([
            'dir' => 'cdn/racebook/retrospects/',
            'acl' => 'public',
            'disk' => 's3',
            'url' => '//cdn.donparlay.com/',
            'ext' => true,
        ], $options));

        $disk = Storage::disk($opt->disk);

        if ($opt->ext) {
            $key_name = $opt->dir . sha1($name) . '.' . $file->getClientOriginalExtension();
        } else {
            $key_name = $opt->dir . sha1($name);
        }

        $exists = false;

        if ($disk->exists($key_name)) {
            $exists = true;
            $disk->delete($key_name);
        }

        $put = $disk->put($key_name, File::get($file), $opt->acl);

        return self::array_object([
            'save' => $put,
            'exists' => $exists,
            'data' => [
                'size' => $file->getClientSize(),
                'name' => $name,
                'original_name' => $file->getClientOriginalName(),
                'mimeType' => $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'url' => $opt->url . str_replace('cdn/', '', $key_name),
            ],
            'string' => sha1($name),
        ]);
    }

    public static function response_xml(array $response_array, $status = 200, $description = 'OK', array $extra_header = [])
    {
        $response_header['Header'] = array_merge([
            'Status' => $status,
            'Description' => $description,
            'Timestamp' => strtotime(date('Y-m-d H:i:s')),
        ], $extra_header);

        $response_array = array_merge($response_header, ['Results' => $response_array]);

        $xml = Array2XMLController::createXML('DotworkersApi', $response_array);

        return response()->make($xml->saveXML(), '200')->header('Content-Type', 'text/xml');
    }

    public static function response_json($content, $status = 200, $error_description = 'OK', $api = true, $pretty = false)
    {
        $return = [
            'Iglekids' => [
                'status' => [
                    'code' => $status,
                    'description' => $error_description,
                ],
                'content' => $content,
            ],
        ];

        if ($api) {
            if ((string)request()->get('pretty') === 'true' || $pretty) {
                return response()->json($return, 200, [], JSON_PRETTY_PRINT);
            } else {
                return response()->json($return, 200);
            }
        } else {
            return self::array_object($return);
        }

    }

    public static function getCountryWhitTimeZone()
    {
        $countries = [
            "AF" => ["name" => "Afghanistan",],
            "AL" => ["name" => "Albania",],
            "DZ" => ["name" => "Algeria",],
            "AS" => ["name" => "American Samoa",],
            "AD" => ["name" => "Andorra",],
            "AQ" => ["name" => "Antarctica",],
            "AG" => ["name" => "Antigua & Barbuda",],
            "AR" => ["name" => "Argentina",],
            "AM" => ["name" => "Armenia",],
            "AU" => ["name" => "Australia",],
            "AT" => ["name" => "Austria",],
            "AZ" => ["name" => "Azerbaijan",],
            "BS" => ["name" => "Bahamas",],
            "BD" => ["name" => "Bangladesh",],
            "BB" => ["name" => "Barbados",],
            "BY" => ["name" => "Belarus",],
            "BE" => ["name" => "Belgium",],
            "BZ" => ["name" => "Belize",],
            "BM" => ["name" => "Bermuda",],
            "BT" => ["name" => "Bhutan",],
            "BO" => ["name" => "Bolivia",],
            "BA" => ["name" => "Bosnia & Herzegovina",],
            "BR" => ["name" => "Brazil",],
            "IO" => ["name" => "British Indian Ocean Territory",],
            "BN" => ["name" => "Brunei",],
            "BG" => ["name" => "Bulgaria",],
            "CA" => ["name" => "Canada",],
            "CV" => ["name" => "Cape Verde",],
            "KY" => ["name" => "Cayman Islands",],
            "TD" => ["name" => "Chad",],
            "CL" => ["name" => "Chile",],
            "CN" => ["name" => "China",],
            "CX" => ["name" => "Christmas Island",],
            "CC" => ["name" => "Cocos (Keeling) Islands",],
            "CO" => ["name" => "Colombia",],
            "CK" => ["name" => "Cook Islands",],
            "CR" => ["name" => "Costa Rica",],
            "CI" => ["name" => "Côte d’Ivoire",],
            "HR" => ["name" => "Croatia",],
            "CU" => ["name" => "Cuba",],
            "CW" => ["name" => "Curaçao",],
            "CY" => ["name" => "Cyprus",],
            "CZ" => ["name" => "Czech Republic",],
            "DK" => ["name" => "Denmark",],
            "DO" => ["name" => "Dominican Republic",],
            "EC" => ["name" => "Ecuador",],
            "EG" => ["name" => "Egypt",],
            "SV" => ["name" => "El Salvador",],
            "EE" => ["name" => "Estonia",],
            "FK" => ["name" => "Falkland Islands (Islas Malvinas)",],
            "FO" => ["name" => "Faroe Islands",],
            "FJ" => ["name" => "Fiji",],
            "FI" => ["name" => "Finland",],
            "FR" => ["name" => "France",],
            "GF" => ["name" => "French Guiana",],
            "PF" => ["name" => "French Polynesia",],
            "TF" => ["name" => "French Southern Territories",],
            "GE" => ["name" => "Georgia",],
            "DE" => ["name" => "Germany",],
            "GH" => ["name" => "Ghana",],
            "GI" => ["name" => "Gibraltar",],
            "GR" => ["name" => "Greece",],
            "GL" => ["name" => "Greenland",],
            "GU" => ["name" => "Guam",],
            "GT" => ["name" => "Guatemala",],
            "GW" => ["name" => "Guinea-Bissau",],
            "GY" => ["name" => "Guyana",],
            "HT" => ["name" => "Haiti",],
            "HN" => ["name" => "Honduras",],
            "HK" => ["name" => "Hong Kong",],
            "HU" => ["name" => "Hungary",],
            "IS" => ["name" => "Iceland",],
            "IN" => ["name" => "India",],
            "ID" => ["name" => "Indonesia",],
            "IR" => ["name" => "Iran",],
            "IQ" => ["name" => "Iraq",],
            "IE" => ["name" => "Ireland",],
            "IL" => ["name" => "Israel",],
            "IT" => ["name" => "Italy",],
            "JM" => ["name" => "Jamaica",],
            "JP" => ["name" => "Japan",],
            "JO" => ["name" => "Jordan",],
            "KZ" => ["name" => "Kazakhstan",],
            "KE" => ["name" => "Kenya",],
            "KI" => ["name" => "Kiribati",],
            "KG" => ["name" => "Kyrgyzstan",],
            "LV" => ["name" => "Latvia",],
            "LB" => ["name" => "Lebanon",],
            "LR" => ["name" => "Liberia",],
            "LY" => ["name" => "Libya",],
            "LT" => ["name" => "Lithuania",],
            "LU" => ["name" => "Luxembourg",],
            "MO" => ["name" => "Macau",],
            "MK" => ["name" => "Macedonia (FYROM)",],
            "MY" => ["name" => "Malaysia",],
            "MV" => ["name" => "Maldives",],
            "MT" => ["name" => "Malta",],
            "MH" => ["name" => "Marshall Islands",],
            "MQ" => ["name" => "Martinique",],
            "MU" => ["name" => "Mauritius",],
            "MX" => ["name" => "Mexico",],
            "FM" => ["name" => "Micronesia",],
            "MD" => ["name" => "Moldova",],
            "MC" => ["name" => "Monaco",],
            "MN" => ["name" => "Mongolia",],
            "MA" => ["name" => "Morocco",],
            "MZ" => ["name" => "Mozambique",],
            "MM" => ["name" => "Myanmar (Burma)",],
            "NA" => ["name" => "Namibia",],
            "NR" => ["name" => "Nauru",],
            "NP" => ["name" => "Nepal",],
            "NL" => ["name" => "Netherlands",],
            "NC" => ["name" => "New Caledonia",],
            "NZ" => ["name" => "New Zealand",],
            "NI" => ["name" => "Nicaragua",],
            "NG" => ["name" => "Nigeria",],
            "NU" => ["name" => "Niue",],
            "NF" => ["name" => "Norfolk Island",],
            "KP" => ["name" => "North Korea",],
            "MP" => ["name" => "Northern Mariana Islands",],
            "NO" => ["name" => "Norway",],
            "PK" => ["name" => "Pakistan",],
            "PW" => ["name" => "Palau",],
            "PS" => ["name" => "Palestine",],
            "PA" => ["name" => "Panama",],
            "PG" => ["name" => "Papua New Guinea",],
            "PY" => ["name" => "Paraguay",],
            "PE" => ["name" => "Peru",],
            "PH" => ["name" => "Philippines",],
            "PN" => ["name" => "Pitcairn Islands",],
            "PL" => ["name" => "Poland",],
            "PT" => ["name" => "Portugal",],
            "PR" => ["name" => "Puerto Rico",],
            "QA" => ["name" => "Qatar",],
            "RE" => ["name" => "Réunion",],
            "RO" => ["name" => "Romania",],
            "RU" => ["name" => "Russia",],
            "WS" => ["name" => "Samoa",],
            "SM" => ["name" => "San Marino",],
            "SA" => ["name" => "Saudi Arabia",],
            "RS" => ["name" => "Serbia",],
            "SC" => ["name" => "Seychelles",],
            "SG" => ["name" => "Singapore",],
            "SK" => ["name" => "Slovakia",],
            "SI" => ["name" => "Slovenia",],
            "SB" => ["name" => "Solomon Islands",],
            "ZA" => ["name" => "South Africa",],
            "GS" => ["name" => "South Georgia & South Sandwich Islands",],
            "KR" => ["name" => "South Korea",],
            "ES" => ["name" => "Spain",],
            "LK" => ["name" => "Sri Lanka",],
            "PM" => ["name" => "St. Pierre & Miquelon",],
            "SD" => ["name" => "Sudan",],
            "SR" => ["name" => "Suriname",],
            "SJ" => ["name" => "Svalbard & Jan Mayen",],
            "SE" => ["name" => "Sweden",],
            "CH" => ["name" => "Switzerland",],
            "SY" => ["name" => "Syria",],
            "TW" => ["name" => "Taiwan",],
            "TJ" => ["name" => "Tajikistan",],
            "TH" => ["name" => "Thailand",],
            "TL" => ["name" => "Timor-Leste",],
            "TK" => ["name" => "Tokelau",],
            "TO" => ["name" => "Tonga",],
            "TT" => ["name" => "Trinidad & Tobago",],
            "TN" => ["name" => "Tunisia",],
            "TR" => ["name" => "Turkey",],
            "TM" => ["name" => "Turkmenistan",],
            "TC" => ["name" => "Turks & Caicos Islands",],
            "TV" => ["name" => "Tuvalu",],
            "UM" => ["name" => "U.S. Outlying Islands",],
            "UA" => ["name" => "Ukraine",],
            "AE" => ["name" => "United Arab Emirates",],
            "GB" => ["name" => "United Kingdom",],
            "US" => ["name" => "United States",],
            "UY" => ["name" => "Uruguay",],
            "UZ" => ["name" => "Uzbekistan",],
            "VU" => ["name" => "Vanuatu",],
            "VA" => ["name" => "Vatican City",],
            "VE" => ["name" => "Venezuela",],
            "VN" => ["name" => "Vietnam",],
            "WF" => ["name" => "Wallis & Futuna",],
            "EH" => ["name" => "Western Sahara",],
        ];

        foreach ($countries as $k => $v) {
            $tz = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $k);

            foreach ($tz as $value) {
                $t = new \DateTimeZone($value);
                $offset = (new \DateTime("now", $t))->getOffset();
                $countries[$k]['timezones'][$value] = self::prettyOffset($offset);
            }
        }

        $countries = array_merge($countries, [
            'UTC' => [
                'name' => 'UTC',
                'timezones' => ['UTC' => 'UTC+00:00'],
            ],
        ]);

        return $countries;
    }

    public static function prettyOffset($offset)
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate('H:i', abs($offset));

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

        return $pretty_offset;
    }

    public static function cURL($url, $method = 'GET', array $o = [], $api = true)
    {
        $options['http']['method'] = $method;

        if (isset($o['header'])) {
            $options['http']['header'] = $o['header'];
        }

        if (isset($o['data'])) {
            $options['http']['content'] = @http_build_query($o['data']);
        }

        $context = @stream_context_create($options);
        $content = @file_get_contents($url, false, $context);

        if ($api) {
            return json_decode($content)->Appp;
        } else {
            return $content;
        }
    }

    public static function api_validator(array $request, array $validate, $return)
    {
        $validator = Validator::make($request, $validate);

        if ($validator->fails()) {
            $status = 403;
            $description = 'Oops! Wrong parameters';
            $response = $validator->errors()->getMessages();

            return self::response_json($response, $status, $description);
        } else {

            return $return();
        }
    }

    public static function route_api($function, $prefix = null, $version = '1.0', array $options = [])
    {
        $prefix = (is_null($prefix) ? 'api/' . $version : 'api/' . $version . '/' . $prefix);

        return \Route::group(array_merge([
            'prefix' => $prefix,
            'middleware' => 'web',
        ], $options), $function);
    }

    public static function route_box($function, $prefix = null, array $options = [])
    {
        $prefix = (is_null($prefix) ? 'admin' : 'admin/' . $prefix);

        return \Route::group(array_merge([
            'prefix' => $prefix,
            'middleware' => [
                'web',
                'auth',
            ],
        ], $options), $function);
    }

    public static function route_auth($function, $prefix = null, array $options = [])
    {
        $prefix = (is_null($prefix) ? 'auth' : 'auth/' . $prefix);

        return \Route::group(array_merge([
            'prefix' => $prefix,
            'middleware' => [
                'web',
            ],
        ], $options), $function);
    }

    public static function route_web($function, $prefix = '', array $options = [])
    {

        return \Route::group(array_merge([
            'prefix' => $prefix,
            'middleware' => [
                'web',
                //'auth.web',
            ],
        ], $options), $function);
    }

    public static function pad($input, $pad_length = 2, $pad_string = "0", $pad_type = STR_PAD_LEFT)
    {
        return str_pad($input, $pad_length, $pad_string, $pad_type);
    }

    public static function number($number, $decimals = 2, $dec_point = '.', $thousands_sep = ',')
    {
        return number_format($number, $decimals, $dec_point, $thousands_sep);
    }

    public static function round($val, $precision = 2, $mode = PHP_ROUND_HALF_DOWN)
    {
        return round($val, $precision, $mode);
    }

    public static function hashid($value, $length = 6)
    {
        return (new Hashids($value, $length))->encode(100, 100);
    }

    public static function menuDefault()
    {
        $array = [
            1 => [
                'name' => 'Dashboard',
                'url' => '/'
            ],
            2 => [
                'name' => 'Gallery',
                'url' => '/gallery'
            ],
            3 => [
                'name' => 'Product',
                'url' => '/product'
            ],
            4 => [
                'name' => 'Contact',
                'url' => '/contact'
            ],
        ];

        return $array;
    }
}