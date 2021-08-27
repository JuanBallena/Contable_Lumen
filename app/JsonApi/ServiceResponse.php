<?php

namespace App\JsonApi;

class ServiceResponse {

    public $message = "";
    public $data = null;
    public $pages = 0;
    public $errors = [];

    function __construct () {}

    public static function ok($data, $pages) 
    {
        $instance = new self();
        $instance->message = "Ok";
        $instance->data = $data;
        $instance->pages = $pages;
        
        return response()->json($instance, 200);
    }

    public static function created($data)
    {
        $instance = new self();
        $instance->message = "Created";
        $instance->data = $data;
        
        return response()->json($instance, 201);
    }

    public static function badRequest($errors) 
    {
        $instance = new self();
        $instance->message = "Bad request";
        $instance->errors = $errors;
        
        return response()->json($instance, 400);
    }

    public static function unauthorized($errors) 
    {
        $instance = new self();
        $instance->message = "Unauthorized";
        $instance->errors = $errors;
        
        return response()->json($instance, 403);
    }
}