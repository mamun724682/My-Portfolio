<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

if (!function_exists('formatDate')) {
    /**
     * formatDate
     *
     * @param mixed $date
     * @param bool $withTime
     *
     * @return string
     */

    function formatDate($date, $withTime = false)
    {
        if ($withTime) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d h:i a');
        }
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
}

if (!function_exists('storagelink')) {
    /**
     * storageLink
     *
     * @param mixed $url
     * @param string $type
     *
     * @return string
     */

    function storagelink($url)
    {
        $defaultImage = 'settings/logo.png';
        if (Storage::exists(config('settings.default_logo'))) {
            $defaultImage = config('settings.default_logo');
        }

        // dd(Storage::disk('public')->exists($url));

        if ($url && Storage::disk('public')->exists($url)) {
            return Storage::url($url);
        } else {
            return Storage::url($defaultImage);
        }
    }
}

if (!function_exists('downloadableLink')) {
    /**
     * downloadableLink
     */

    function downloadableLink($url, $disk = 'public')
    {
        return Storage::disk($disk)->url($url);
    }
}

// Get image
if (!function_exists('getGlobalImage')) {
    /**
     * @return string
     */
    function getGlobalImage($path,$name)
    {
        if(is_null($name)){
            return  getDefaultImage();
        }
        return Storage::disk('public')->exists('storage/'.$path.'/'.$name)
            ? asset('storage/'.$path.'/'.$name)
            : getDefaultImage();
    }
}
// Get default image
if (!function_exists('getDefaultImage')) {
    /**
     * @return string
     */
    function getDefaultImage()
    {
        return asset('/images/default.png');
    }
}
// Get image
if (!function_exists('getImage')) {
    /**
     * @return string
     */
    function getImage($url = null)
    {
        if (Storage::disk('public')->exists($url)) {
            return '/storage/'.$url;
        } else {
            return getDefaultImage();
        }
    }
}


if (!function_exists('getRandomNumber')) {
    /**
     * getRandomNumber
     *
     * @param int $length
     *
     * @return string
     */

    function getRandomNumber($length = 8)
    {
        $characters = '0123456789';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}


if (!function_exists('checkPermission')) {
    /**
     * checkPermission
     *
     * @param mixed $permissions
     *
     * @return void
     */

    function checkPermission($permissions)
    {
        if (!auth()->user()->can($permissions)) {
            abort(403);
        }
    }
}


if (!function_exists('prefixGenerator')) {
    /**
     * prefixGenerator
     *
     * @param Model $model
     * @param string $prefix
     *
     * @return string
     */

    function prefixGenerator(Model $model, $prefix = 'IC-')
    {
        $countNumber = $model::count();
        return $prefix . sprintf('%06d', $countNumber + 1);
    }
}

if (!function_exists('systemSettings')) {
    /**
     * systemSettings
     *
     * @param string $columnName
     * @param string $configName
     *
     * @return string
     */
    function systemSettings($columnName = '', $configName = "settings")
    {
        return config($configName . '.' . $columnName);
    }
}

if (!function_exists('getPageMeta')) {
    /**
     * get_page_meta
     *
     * @param string $metaName
     *
     * @return mixed
     */
    function getPageMeta($metaName = "title", $default = "")
    {
        if (session()->has('page_meta_' . $metaName)) {
            $title = session()->get("page_meta_" . $metaName);
//            session()->forget("page_meta_" . $metaName);
            return $title ?? $default;
        }
        return $default;
    }
}


if (!function_exists('setPageMeta')) {
    /**
     * set_page_meta
     *
     * @param null $content
     * @param string $metaName
     *
     * @return void
     */
    function setPageMeta($content = null, $metaName = "title")
    {
        if ($metaName == 'title')
            session()->put('page_meta_header', $content);
        session()->put('page_meta_' . $metaName, $content);
    }
}

if (!function_exists('log_error')) {

    /**
     * Log error
     *
     * @param \Exception $e
     * @return void
     */
    function log_error(\Exception $e)
    {
        Log::error($e->getMessage());
    }
}

if (!function_exists('sendFlash')) {
    /**
     * sendFlash
     *
     * @param mixed $message
     * @param string $type
     *
     * @return void
     */

    function sendFlash($message, $type = 'success')
    {
        session()->flash($type, $message);
    }
}

if (!function_exists('something_wrong_flash')) {

    /**
     * send flash message when error happened
     *
     * @param string|null $message
     * @return void
     */
    function something_wrong_flash($message = null)
    {
        Session::flash('error', $message ?? 'Something wrong!');
    }
}
