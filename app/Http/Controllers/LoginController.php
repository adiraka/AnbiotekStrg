<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Anbiotek\Http\Requests;
use Sentinel;
use Session;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login.index');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Sentinel::authenticate($credentials)) {
            $user = Sentinel::getUser();
            $admin = Sentinel::findRoleBySlug('admin');
            if ($user->inRole($admin)) {
                Session::flash('success','Welcome Mr/Mrs. '.Sentinel::getUser()->first_name.', how are you today?');
                return redirect()->route('admin');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function logout()
    {
        Sentinel::logout();
        return redirect('login');
    }
}
