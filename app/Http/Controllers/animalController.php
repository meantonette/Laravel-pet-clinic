<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
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
        //$animals = Animal::withTrashed()->paginate(5);
        //return view("animals.index", [
          //  "animals" => $animals,
        //]);

        
        $animals = DB::table('rescuers')
        ->leftJoin('animals','animal.rescuer_id','=','rescuer.rescuer_id')
        ->select('rescuer.*','animals.*')
        ->withTrashed()
        ->paginate(5)
        ->get();
        return view("animals.index", [
            "animals" => $animals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rescuers = Rescuer::pluck('first_name','rescuer_id');
        return view("animals.create", ["rescuers" => $rescuers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(animalRequest $request)
    {
        $animals = new Animal();
        $animals->animal_name = $request->input("animal_name");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->type = $request->input("type");
        $animals->rescuer_id = $request->input("rescuer_id");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->save();
        return Redirect::to("/animals")->with("add", "New Animal Added!");
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
        $rescuers = Rescuer::pluck('first_name','rescuer_id');
        return view("animals.edit", [
            "animals" => $animals,
            "rescuers" => $rescuers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(animalRequest $request, $animals_id)
    {
        $animals = Animal::find($animals_id);
        $animals->animal_name = $request->input("animal_name");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->type = $request->input("type");
        $animals->rescuer_id = $request->input("rescuer_id");
        if ($request->hasfile("images")) {
            $destination = "uploads/animals/" . $animals->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->update();
        return Redirect::to("/animals")->with("update", "Animal Data Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($animals_id)
    {
        $animals = Animal::findOrFail($animals_id);
        //$destination = 'uploads/animals/'.$animals->images;
        //if(File::exists($destination))
        //{
        //  File::delete($destination);
        //}
        $animals->delete();
        return Redirect::to("/animals")->with("delete", "Animal Data Deleted!");
    }

    public function restore($animals_id)
    {
        Animal::onlyTrashed()
            ->findOrFail($animals_id)
            ->restore();
        return Redirect::route("animals.index")->with(
            "restore",
            "Animal Data Restored!"
        );
    }

    public function forceDelete($animals_id)
    {
        Animal::withTrashed()
            ->findOrFail($animals_id)
            ->forceDelete();
        return Redirect::route("animals.index")->with(
            "force",
            "Animal Data Permanently Deleted!"
        );
    }
}
