<?php

namespace HertzApi\Http\Controllers\API;

use HertzApi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;
use DB;
use Hash;

class APIController extends Controller
{

    public static function json_error_message($msg, $http_status)
    {
        $json = json_encode([
            'data' => $msg
        ]);

        return response($json, $http_status)
            ->header('Content-Type', 'application/json');
    }

    public static function json_empty_success()
    {
        $json = '{"data": {}}';
        return response($json, 200)->header('Content-Type', 'application/json');
    }

    public static function json_success($data)
    {
        $obj = new \stdClass();
        $obj->data = $data;
        $json = json_encode($obj);

        return response($json, 200)->header('Content-Type', 'application/json');
    }

    public static function json_success_without_data($data)
    {
        $json = json_encode($data);

        return response($json, 200)->header('Content-Type', 'application/json');
    }
}
