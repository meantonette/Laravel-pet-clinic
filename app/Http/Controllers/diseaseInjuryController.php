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
        $disease_injuries = DiseaseInjury::withTrashed()->paginate(5);
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
        $animals = Animal::all();
        return view('disease_injuries.create',['animals' => $animals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(diseaseInjuryRequest $request)
    {
        DiseaseInjury::create($request->all());
            return Redirect::to('diseaseinjury')->with('add','Disease/Injury has been added!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $animals = Animal::all();
        return view('disease_injuries.edit',[
            'animals' => $animals,
            'disease_injuries' => $disease_injuries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(diseaseInjuryRequest $request, $id)
    {
        $disease_injuries = DiseaseInjury::find($id);
        $disease_injuries->classify = $request->input('classify');
        $disease_injuries->animals_id = $request->input('animals_id');
        $disease_injuries->update();
        return Redirect::to('diseaseinjury')->with('update','Disease/Injury Data has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disease_injuries = DiseaseInjury::find($id);
        $disease_injuries->delete();

    public function restore($id)
    {
        DiseaseInjury::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("diseaseinjury.index")->with(
            "restore",
            "Disease/Injury Data Restored!"
        );
    }
}
