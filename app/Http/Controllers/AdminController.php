<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ban;
use App\Models\User;

class AdminController extends Controller
{
    public function show(){ 
        if(!Auth::check()){
            return redirect("/home");
        }
        $user = User::find(Auth::user()->id);

        $bannedUsers = User::join('ban', 'ban.id_banned', '=', 'users.id')
        ->select('users.username', 'ban.reason', 'ban.date')
        ->get();
        if($user->administrator){
            return view('pages.dashboardAdmin',['bans' => $bannedUsers, 'user' =>$user]);
        }else{
            return abort(403, 'Unauthorized action.');
        }
    }

    public function banUser(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }
        $user = User::find($request->get('idToBan'));
        if(!$user->banned()){
            $ban = new Ban;
            $ban->reason = $request->get('banMotive');
            $ban->date = now();
            $ban->id_banned = $user->id;
            $ban->id_admin = Auth::user()->id;
            $ban->save();
        }
        return redirect()->back();
    }

    public function unbanUser(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }
        $ban = Ban::where('id_banned',$request->get('idToUnBan'));
        if($ban != null){
            $ban->delete();
        }
        
        return redirect()->back();
    }
}