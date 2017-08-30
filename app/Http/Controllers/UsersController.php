<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use Illuminate\Http\Request;

use App\Http\Requests;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('users.register');
    }

    public function login()
    {
        return view('users.login');
    }

    public function signin(Requests\UserLoginRequest $request)
    {
        //dd($request->all());
        if(\Auth::attempt([
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'is_confirmed'=>1
        ])){
            return redirect('/');
        }
        \Session::flash('user_login_failed','密码不正确或邮箱未认证');
        return redirect('/user/login')->withInput();

    }

    public function avatar()
    {
        return view('users.avatar');
    }

    public function changeAvatar(Request $request)
    {
//        dd($request->all());
        $file = $request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }

        $destinationPath = 'uploads/';
        $filename = \Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        Image::make($destinationPath.$filename)->fit(400)->save();
//        $user = User::findOrFail(\Auth::user()->id);
//        $user->avatar = '/'.$destinationPath.$filename;
//        $user->save();

        return \Response::json(
            [
                'success' => true,
//                'avatar' => '/'.$destinationPath.$filename,
                'avatar'=>asset($destinationPath.$filename),
                'image'=>$destinationPath.$filename,
            ]
        );
       // return redirect('/user/avatar');
    }

    public function cropAvatar(Request $request)
    {
//        dd($request->all());
//        $photo = mb_substr($request->get('photo'),1);
        $photo = $request->get('photo');
        $width = (int)$request->get('w');
        $height = (int)$request->get('h');
        $xAlign = (int)$request->get('x');
        $yAlign = (int)$request->get('y');
        Image::make($photo)->crop($width,$height,$xAlign,$yAlign)->save();

        $user = \Auth::user();
        $user->avatar = asset($photo);
        $user->save();
        return redirect('/user/avatar');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRegisterRequest $request)
    {
        $data=array_merge($request->all(),['avatar'=>'/image/default-avatar.jpg','confirm_code'=>str_random(48)]);
        User::register($data);
        //return redirect('/');

        return redirect('/success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmEmail($confirm_code)
    {
        //dd($confirm_code);
        $user=User::where('confirm_code',$confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }
        $user->is_confirmed=1;
        $user->confirm_code=str_random(48);
        //dd($user->confirm_code);
        $user->save();
        return redirect('user/login');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }
}
