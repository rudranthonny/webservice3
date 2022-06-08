<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    private $token = '3965c3e3228fac0de59b88b77c2625fb';
    private $domainname = 'http://aprendiendo.jademlearning.com/webservice/rest/server.php';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ap_paterno' => 'required',
            'ap_materno' => 'required',
            'dni' => 'required|unique:users',
            'celular' => 'required',
            'email' => 'required|unique:users',
        ]);
        /*Crear usuario en Moodle*/
        $functionname = 'core_user_create_users';
        $serverurl = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&users[0][username]='.$request->input('dni').'&users[0][password]='.$request->input('dni').'&users[0][firstname]='.$request->input('name').'&users[0][lastname]='.$request->input('ap_paterno')." ".$request->input('ap_materno').'&users[0][email]='.$request->input('email').'&users[0][phone1]='.$request->input('celular').'&users[0][country]=PE';
        $nm_use=Http::get($serverurl);
        foreach (json_decode($nm_use) as  $nm_use2) {
        }
        /*crear usuario en el sistema*/
        $n_use = new User();
        $n_use->name = $request->input('name');
        $n_use->ap_paterno = $request->input('ap_paterno');
        $n_use->ap_materno = $request->input('ap_materno');
        $n_use->dni = $request->input('dni');
        $n_use->estado = 1;
        $n_use->email = $request->input('email');
        $n_use->celular = $request->input('celular');
        $n_use->id_user_moodle = $nm_use2->id;
        $n_use->password = bcrypt($request->input('dni'));
        $n_use->save();
        return redirect()->route('users.index')->with('info','El usuario se creo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //validación
        $request->validate([
            'name' => 'required',
            'ap_paterno' => 'required',
            'ap_materno' => 'required',
            'dni' => 'required|unique:users,dni,'.$user->id,
            'celular' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        /*modificar el usuario en moodle*/
        $functionname = 'core_user_update_users';
        $serverurl = $this->domainname. '/webservice/rest/server.php'
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&users[0][id]='.$user->id_user_moodle.
        '&users[0][firstname]='.$request->input('name').
        '&users[0][lastname]='.$request->input('ap_paterno').' '.$request->input('ap_materno').
        '&users[0][email]='.$request->input('email').
        '&users[0][phone1]='.$request->input('celular');
         Http::get($serverurl);
        /*modificar el usuario en elsistema*/
        $user->name = $request->input('name');
        $user->ap_paterno = $request->input('ap_paterno');
        $user->ap_materno = $request->input('ap_materno');
        $user->dni = $request->input('dni');
        $user->email = $request->input('email');
        $user->celular = $request->input('celular');
        $user->save();
        return redirect()->route('users.index')->with('info','El usuario se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //eliminar del moodle
        $functionname2 = 'core_user_delete_users';
        $serverurl2 = $this->domainname. '/webservice/rest/server.php'
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname2
        .'&moodlewsrestformat=json&userids[0]='.$user->id_user_moodle;
        Http::get($serverurl2);
        //eliminar del sistema
        $user->delete();
        return redirect()->route('users.index')->with('info','El usuario se elimino correctamente');
    }
    public function suspender(User $user){
    
        if($user->estado == 0 or $user->estado == null)
        {
            $user->estado = 1;
        }
        else
        {
            $user->estado = 0;
        }
        $user->save();
        //actualizar en moodle
        User::suspender($user);
        /*modificar el usuario en moodle*/
         return redirect()->route('users.index')->with('info','El usuario se actualizo correctamente');
    }
}
