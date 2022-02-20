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