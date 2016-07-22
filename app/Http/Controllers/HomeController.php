<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    public $user;
    protected $view;

    public function __construct()
    {
        $this->middleware('auth');
        $this->view = view('home');
        $this->user = Auth::user();
    }

    public function index()
    {
        $view = $this->view;

        if (!Auth::check()) {
            $view->with('content', view('auth.login'));
        }

        return $view;
    }
}

