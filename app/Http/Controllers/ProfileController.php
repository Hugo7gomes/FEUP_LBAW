<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Photo;
use App\Models\Projects;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ProfileController extends Controller
{
    public function show(){
        if(!Auth::check()){
            return redirect("/home");
        }
        
        $user = User::find(Auth::user()->id);

        $this->authorize('show', $user);
        
        return view('pages.profile',[ 'user' => $user]);
    }
    
    public function showUser($username){
        if(!Auth::check()){
            return redirect("/home");
        }

        $user = User::find(Auth::user()->id);
        $userProfile = User::where('username', $username)->first();

        if(is_null($userProfile)){
            return abort(404);
        }
        
        return view('pages.othersProfile',[ 'user' => $user, 'userProfile' => $userProfile]);
    }

    public function update(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(),[
            'email' => 'nullable|string|email|max:255|unique:users',
            'username' => 'nullable|string|max:255|unique:users',
            'name' => 'nullable|string|max:255|unique:users',
            'new_password' => 'nullable|string|min:6',
            'password' => ['required_with:new_password', 'string','min:6','nullable',function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'phone_number' => 'nullable|numeric|digits:9|',
        ]);

        if($validator->fails()){
            foreach($validator->errors()->messages() as $key => $value){
                $errors[$key] = $value;
            }
            
            return redirect()->back()->withInput()->withErrors($errors);
        }   

        if(!Auth::check()) return redirect('/');
        
        $this->authorize('update', $user);
    
        $user->name = empty($request->get('name')) ? $user->name : $request->input('name');
        $user->email = empty($request->get('email')) ? $user->email : $request->input('email');
        $user->password = empty($request->get('new_password')) ? $user->password : bcrypt($request->input('new_password'));
        Auth::user()->password = $user->password;
        $user->phone_number = empty($request->get('phone_number')) ? $user->phone_number : $request->input('phone_number');
        $user->username = empty($request->get('username')) ? $user->username : $request->input('username');
        $user->save(); 

        return back()->with("status","Profile updated");
    }

    private function saveImage(String $imgData, int $id){
        $fileName = 'user/'.$id.'.png';

        Storage::disk('local')->put($fileName, base64_decode($imgData));
    }

    public function updateAvatar(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }
        
        $user = User::find(Auth::user()->id);
        
        $photo = Photo::where('id_user', $user->id)->first();
        if(!empty($request->get('avatar'))){
            $photo->path = "storage/avatars/user".$user->id.".png";
            $photo->save();
            $fileName = "user".$user->id.".png";
            $request->file('avatar')->storeAs(
                storage_path('avatars'), $fileName
            );
        }

        return redirect("profile");

    }

    
}
