<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Faq;

class FaqpageController extends Controller
{
    public function show(){
        $faqs = Faq::all();
        if(Auth::check()){
            $admin = User::find(Auth::user()->administrator);
            $user = User::find(Auth::user()->id);
            return view('pages.faqPage',['faqs' => $faqs, 'admin' => True, 'user' =>$user]);
        }
        else{
            return view('pages.faqPage',['faqs' => $faqs, 'admin' => False, 'user' => null]);
        }
    }

    public function create(Request $request){
        $faq = new Faq;
        $faq->question = $request -> input('question');
        $faq->answer = $request-> input('answer');
        $faq->save();

        return redirect()->route('faq');
    }
}