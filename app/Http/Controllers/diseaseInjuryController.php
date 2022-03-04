<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Http\Requests\diseaseInjuryRequest;
use App\Models\DiseaseInjury;
use App\Models\Animal;

class diseaseInjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disease_injuries = DiseaseInjury::join(
            "animals",
            "animals.id",
            "=",
            "disease_injuries.animals_id"
        )
            ->select(
                "disease_injuries.id",
                "disease_injuries.classify",
                "disease_injuries.deleted_at",
                "animals.animal_name"
            )
            ->orderBy("disease_injuries.id", "ASC")
            ->withTrashed()
            ->paginate(2);
        return view("disease_injuries.index", [
            "disease_injuries" => $disease_injuries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::pluck("animal_name", "id");
        return view("disease_injuries.create", ["animals" => $animals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(diseaseInjuryRequest $request)
    {
        $disease_injuries = $request->all();
        DiseaseInjury::create($disease_injuries);
        return Redirect::to("/diseaseinjury")->with(
            "success",
            "Disease/Injury has been added!"
        );
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
    public function edit($id)
    {
        $disease_injuries = DiseaseInjury::find($id);
        $animals = Animal::pluck("animal_name", "id");
        return view("disease_injuries.edit", [
            "animals" => $animals,
            "disease_injuries" => $disease_injuries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $disease_injuries = DiseaseInjury::find($id);
        $disease_injuries->update($request->all());
        return Redirect::to("/diseaseinjury")->with(
            "success",
            "Disease/Injury Data has been updated!/"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DiseaseInjury::destroy($id);
        return Redirect::to("/diseaseinjury")->with(
            "success",
            "Adopter Data Deleted!"
        );
    }

    public function restore($id)
    {
        DiseaseInjury::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("diseaseinjury.index")->with(
            "success",
            "Disease/Injury Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        DiseaseInjury::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
        return Redirect::route("diseaseinjury.index")->with(
            "success",
            "Disease/Injury Data Permanently Deleted!"
        );
    }
}
