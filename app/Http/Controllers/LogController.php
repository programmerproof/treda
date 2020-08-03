<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $content = array();
        $name = 'public/infoProduct.log';
        $exist = \Storage::exists($name); 
        if($exist){
           $content = explode("\r\n", \Storage::get($name));
        }
        return view('log.index', compact('content'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function message()
    {
        $data = '';
        return view('home')->with('message', $data);
    }
}
