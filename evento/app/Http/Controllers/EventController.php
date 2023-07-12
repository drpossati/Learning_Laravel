<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{

    // Convenção do Laravel
    public function index()
    {
        return view('welcome');
    }

    public function create()
    {
        return view('events.create');
    }

}