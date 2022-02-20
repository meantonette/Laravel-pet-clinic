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
        $disease_injuries = DiseaseInjury::all();
        return view('disease_injuries.index',[
            'disease_injuries' => $disease_injuries
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

