<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }
    
    public function testComponents()
    {
        return view('test_components');
    }
    
    public function simpleTest()
    {
        return view('simple_test');
    }
    
    public function debugInput()
    {
        return view('debug_input');
    }
}
