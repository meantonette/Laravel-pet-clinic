<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Http\Requests\animalRequest;
use App\Models\Rescuer;

class animalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::with('rescuer')->get();
        return view('animals.index',[
            'animals' => $animals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rescuers = Rescuer::all();
        return view('animals.create',['rescuers' => $rescuers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $animals = new Animal;
        $animals->animal_name = $request->input('animal_name');
        $animals->age = $request->input('age');
        $animals->gender = $request->input('gender');
        $animals->type = $request->input('type');
        $animals->rescuer_id = $request->input('rescuer_id');
        if($request->hasfile('images'))
        {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/animals/', $filename);
            $animals->images = $filename;
        }
        $animals->save();
        return Redirect::to('/animals')->with('add','New Animal Added!'); 
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
    public function edit($animals_id)
    {
        $animals = Animal::find($animals_id);
        $rescuers = Rescuer::all();
        return view('animals.edit',[
            'animals' => $animals,
            'rescuers' => $rescuers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    { 
        $animals = Animal::find($animals_id);
        $animals->animal_name = $req->input('animal_name');
        $animals->age = $req->input('age');
        $animals->gender = $req->input('gender');
        $animals->type = $req->input('type');
        if($req->hasfile('animal_pic'))
        {
            $destination = 'uploads/animals/'.$animals->animal_pic;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('animal_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/animals/', $filename);
            $animals->animal_pic = $filename;
        }
        $animals->update();
        return redirect('/animals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($animals_id)
    {
        $animals = Animal::find($animals_id);
        $destination = 'uploads/animals/'.$animals->animal_pic;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $animals->delete();
        return redirect('/animals');
    }
}
