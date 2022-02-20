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

