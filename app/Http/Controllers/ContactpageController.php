<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ContactpageController extends Controller
{
    public function show(){
        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            return view('pages.contactPage',['user' => $user]);
        }
        else{
            return view('pages.contactPage',['user' => null]);
        }
    }
}