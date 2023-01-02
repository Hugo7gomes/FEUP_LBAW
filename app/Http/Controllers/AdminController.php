<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ban;
use App\Models\User;

class AdminController extends Controller
{
    public function show(){ 
            $user = User::find(Auth::user()->id);

            $bannedUsers = User::join('ban', 'ban.id_banned', '=', 'users.id')
            ->select('users.username', 'ban.reason', 'ban.date')
            ->get();
            
            return view('pages.dashboardAdmin',['bans' => $bannedUsers, 'user' =>$user, 'loggedIn' => Auth::check()]);
    }
}