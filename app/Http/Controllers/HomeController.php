<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresa = Company::first();
        $appName = config('app.name');
        $showSidebar = true;
        //dd($empresa);
        return view('home',['showSidebar' => $showSidebar, 'appName'=> $appName, 'empresa'=> $empresa]);
    }

}