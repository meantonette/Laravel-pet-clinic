<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\personnelRequest;
use App\Http\Requests\personnelUpdateController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Personnel;

class personnelController extends Controller
{

    public function login()
    {
        return view('personnels.login');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $req)
    {
       $check = Personnel::where('email', $req->email)->first();
       if ($check) {
            if(Hash::check($req->password, $check->password)) {
                $req->session()->put('id', $check->personnel_id);
                return redirect('dashboard');
            } else{
                return view('personnels.login');
            }
       } else{
            return view('personnels.login');
       }
    }

    public function dashboard()
    {
       $personnel = array();
        if (Session::has('id')){
          $personnel = Personnel::where('personnel_id', Session::get('id'))->first();
        }
        return view('personnels.dashboard', compact('personnel'));
    }

    public function logout()
    {
        if (Session::has('id')){
            Session::pull('id');
            return redirect('login');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnels = Personnel::all();
        return view('personnels.index',[
            'personnels' => $personnels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personnels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personnelRequest $request)
    {
        $personnels = new Personnel;
        $personnels->full_name = $request->input('full_name');
        $personnels->email = $request->input('email');
        $personnels->password = Hash::make($request->input('password'));
        $personnels->role = $request->input('role');
        if($request->hasfile('images'))
        {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/personnels/', $filename);
            $personnels->images = $filename;
        }
        $personnels->save();
            return Redirect::to('login'); 
    }

