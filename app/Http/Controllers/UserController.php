<?php

namespace App\Http\Controllers;
use Request;


class UserController extends Controller {
    /* References Database */

    public function __construct() {
        $this->middleware('auth');
    }

    public function listUsers() {
        $list_users = \App\User::all();
        return view('pages.listuser', [
            'users' => $list_users
        ]);
    }

    /* Create user */

    public function getCreate() {
        return view('pages.newuser');
    }

    protected function postCreate(\Illuminate\Http\Request $request) {
        $user = new \App\User();

        $user->name = Request::get('name');
        $user->email = Request::get('email');
        $user->user = Request::get('user');
        $user->type = Request::get('type');

        $user->password = \Illuminate\Support\Facades\Hash::make(Request::get('password'));

        $user->image = Request::file('image');

        //dd(Request::get('type'));

        $data['image'] = $user->image;

        if (Request::hasFile('image') && Request::file('image')->isValid())
        {

            $name = md5(uniqid());
            $ext = $user->image->getClientOriginalExtension();
            $path = "$name.{$ext}";
            $user->image = "$name.{$ext}";
            $upload = $request->image->storeAs('users', $path);

            if(!$upload) {
                return redirect()->back()->with('error', 'Falha ao carregar imagem');
            }

        }
        
        $user->save();
        if ($user) {
            return redirect()->route('novo')->with('success', 'Usuário Atualizado!');

            return redirect()->back()->with('error', 'Falha ao atualizar usuário!');
        }
    }

    /* Edit user */

    public function getEdit($id) {
        $userid = \App\User::find($id);
        $user = \Illuminate\Support\Facades\Auth::user();
        $users = \App\User::class;

        if ($user->id == $userid->id || $user->type == 'admin')
            return \Illuminate\Support\Facades\View::make('pages.edituser', compact('user', 'userid', 'users'), ['users' => $users], ['userid' => $userid], ['user' => $user]);
        else {
            return \Illuminate\Support\Facades\Redirect::to('/home');
        }
    }

    public function postEdit(\Illuminate\Http\Request $request) {

        $user = \App\User::find(Request::get('id'));
        $user->name = Request::get('name');
        $user->email = Request::get('email');
        $user->image = $request->image;

        $id = $user;


        if (Request::get('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make(Request::get('password'));
        }

        if (Request::get('type')) {
            $user->type = (Request::get('type'));
        }
        
        $data['image'] = $user->image;
        
        if (Request::hasFile('image') && Request::file('image')->isValid())
        {

                $name = md5(uniqid());
                $ext = $user->image->getClientOriginalExtension();
                $path = "{$user->id}/$name.{$ext}";
                $user->image = "$name.{$ext}";
                $upload = $request->image->storeAs('users', $path);
                
                if(!$upload) {
                    return redirect()->back()->with('error', 'Falha ao carregar imagem');
                }
                
        }


        $user->save();

        if ($user) {
            return redirect()->route('perfil', $id)->with('success', 'Usuário Atualizado!');

            return redirect()->back()->with('error', 'Falha ao atualizar usuário!');
        }
    }

    /* Delete user */

    public function getDelete($id) {
        $user = \App\User::find($id);
        $user->delete();

        if ($user) {
            return redirect()->route('usuarios')->with('success', 'Usuário Atualizado!');

            return redirect()->back()->with('error', 'Falha ao atualizar usuário!');
        }
    }

}
