<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Http\Requests\PasswordPutRequest;
use App\Http\Requests\UserPutRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VisitorController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('pages.home')->with('categories',$categories);
    }

    public function changePassword(Request $request, PasswordPutRequest $passwordPutRequest){
        $passwordPutRequest->validated();

        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('dashboard');
    }

    public function changePasswordRequest(){
        return view('auth.passwords.change');
    }

    public function editProfileRequest(){
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $custumor = Customer::where('user_id',$user->id)->first();
//        dd($custumor);
        return view('auth.editprofile')->with('customer', $custumor)->with('user', $user);
    }

    public function editProfile(Request $request, UserPutRequest $userPutRequest){
        $userPutRequest->validated();

        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $user->name = $request->voornaam  . ' '. $request->tussenvoegsel . ' '. $request->achternaam;
        $user->email = $request->email;
        $user->save();

        $custumor = Customer::where('user_id',$user->id)->first();
        $custumor->firstname = $request->voornaam;
        $custumor->preprovision = $request->tussenvoegsel;
        $custumor->lastname = $request->achternaam;
        $custumor->address = $request->adres;
        $custumor->postal_code = $request->postcode;
        $custumor->telefoonnummer = $request->telefoonnummer;
        $custumor->save();

        return redirect()->route('dashboard');
    }
}
