<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use JWTAuthException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate(5);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
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
        $this->validate($request,[
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'birthday'=>'required',
            'gender'=>'nullable',
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->birthday = $request->input('birthday');
        $user->gender = $request->input('gender');
        $user->save();
        return response()->json(['status'=>true,'message'=>'User successfully update','data'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['status'=>true,'message'=>'User successfully deleted','data'=>$user]);
    }

    //User Authentication Code
    private $user;
    public function __construct(User $user){
        $this->user = $user;
        $this->middleware('jwt.auth')->except(['login','register','show']);
    }

    /**
     * Allows user registration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request){
        $data = $request->json()->all();
        $user = $this->user->create([
            'personal_id' => $data['personal_id'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'role' => 1,
        ]);
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user]);
    }

    /**
     * Allows user logging using email/password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->json()->all();
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    /**
     * Returns user associated with token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

}
