<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\rescuerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Models\Rescuer;

class rescuerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rescuers = Rescuer::all();
        return view('rescuers.index',[
            'rescuers' => $rescuers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rescuers.create');
    }

