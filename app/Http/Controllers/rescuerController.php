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
        $rescuers = Rescuer::withTrashed()->paginate(5);
        return view("rescuers.index", [
            "rescuers" => $rescuers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("rescuers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(rescuerRequest $request)
    {
        $rescuers = new Rescuer();
        $rescuers->first_name = $request->input("first_name");
        $rescuers->last_name = $request->input("last_name");
        $rescuers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/rescuers/", $filename);
            $rescuers->images = $filename;
        }
        $rescuers->save();
        return Redirect::to("rescuer")->with("add", "New Rescuer Added!");
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
    public function edit($rescuer_id)
    {
        $rescuers = Rescuer::find($rescuer_id);
        return view("rescuers.edit")->with("rescuers", $rescuers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(rescuerRequest $request, $rescuer_id)
    {
        $rescuers = Rescuer::find($rescuer_id);
        $rescuers->first_name = $request->input("first_name");
        $rescuers->last_name = $request->input("last_name");
        $rescuers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/rescuers/" . $rescuers->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/rescuers/", $filename);
            $rescuers->images = $filename;
        }
        $rescuers->update();
        return Redirect::to("rescuer")->with("update", "Rescuer Data Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rescuer_id)
    {
        $rescuers = Rescuer::findOrFail($rescuer_id);
        //$destination = 'uploads/rescuers/'.$rescuers->images;
        //if(File::exists($destination))
        //{
        //File::delete($destination);
        //}
        $rescuers->delete();
        return Redirect::to("rescuer")->with("delete", "Rescuer Data Deleted!");
    }

    public function restore($rescuer_id)
    {
        Rescuer::onlyTrashed()
            ->findOrFail($rescuer_id)
            ->restore();
        return Redirect::route("rescuer.index")->with(
            "restore",
            "Rescuer Data Restored!"
        );
    }

    public function forceDelete($rescuer_id)
    {
        Rescuer::withTrashed()
            ->findOrFail($rescuer_id)
            ->forceDelete();
        return Redirect::route("rescuer.index")->with(
            "force",
            "Rescuer Data Permanently Deleted!"
        );
    }
}
