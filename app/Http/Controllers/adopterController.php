<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Http\Requests\adopterRequest;
use App\Models\Animal;
use App\Models\Adopter;

class adopterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adopters = Adopter::all();
        return view('adopters.index',[
            'adopters' => $adopters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::all();
        return view('adopters.create',['animals' => $animals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adopterRequest $request)
    {
        $adopters = new Adopter();
        $adopters->first_name = $request->input('first_name');
        $adopters->last_name = $request->input('last_name');
        $adopters->phone_number = $request->input('phone_number');
        $adopters->animals_id = $request->input('animals_id');
        if($request->hasfile('images'))
        {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/adopters/', $filename);
            $adopters->images = $filename;
        }
        $adopters->save();
            return Redirect::to('/adopter')->with('add','New Adopter Added!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($adopter_id)
    {
        $adopters = Adopter::find($adopter_id);
        $animals = Animal::all();
        return view('adopters.edit',[
            'animals' => $animals,
            'adopters' => $adopters
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(adopterRequest $request, $adopter_id)
    {
        $adopters = Adopter::find($adopter_id);
        $adopters->first_name = $request->input('first_name');
        $adopters->last_name = $request->input('last_name');
        $adopters->phone_number = $request->input('phone_number');
        $adopters->animals_id = $request->input('animals_id');
        if($request->hasfile('images'))
        {
            $destination = 'uploads/adopters/'.$adopters->images;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/adopters/', $filename);
            $adopters->images = $filename;
        }
        $adopters->update();
        return Redirect::to('/adopter')->with('update','Adopter Data Updated!'); 
    }

    /**
