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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(rescuerRequest $request)
    {
        $rescuers = new Rescuer;
        $rescuers->first_name = $request->input('first_name');
        $rescuers->last_name = $request->input('last_name');
        $rescuers->phone_number = $request->input('phone_number');
        if($request->hasfile('images'))
        {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/rescuers/', $filename);
            $rescuers->images = $filename;
        }
        $rescuers->save();
            return Redirect::to('rescuer')->with('add','New Rescuer Added!'); 
    }

    /**