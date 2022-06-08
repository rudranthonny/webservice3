<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Periodo;
use App\Models\Plantilla;
use App\Models\User;
use DASPRiD\EnumTest\Planet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GradoController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function show($periodo)
    {
        $periodo = Periodo::find($periodo);
        return view('grados.show',compact('periodo'));
    }

    public function consultar(Grado $grado)
    {   
        //consultar usuarios que no estan matriculados en este grado
        $users = User::whereNotExists(function ($query) use($grado) {
            $query->select()
                  ->from('grado_user')
                  ->whereColumn('grado_user.user_id', 'users.id')
                  ->where('grado_user.grado_id',$grado->id);
        })
        ->get();
            return view('grados.matricular',compact('grado','users'));
    }
    public function matricular(Request $request,Grado $grado)
    {   $user = User::find($request->input('user_id'));
        //matricular estudiante en el sistema
        $grado->users()->attach($user->id);
        foreach($grado->areas as $area){
        //matricular estudiante en el curso
        $functionname2 = 'enrol_manual_enrol_users';
        $serverurl2 = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname2
        .'&moodlewsrestformat=json&enrolments[0][roleid]=5&enrolments[0][userid]='.$user->id_user_moodle.'&enrolments[0][courseid]='.$area->id_course_moodle;
        Http::get($serverurl2);
        }
        return redirect()->route('grado.consultar',$grado->id);
    }
    public function desmatricular(Grado $grado, User $user){
        //desmatricular del sistema
        $user->grados()->detach($grado->id);
        //desmatricular en el sistema
        foreach ($grado->areas as $area) {
            //desmatricular estudiante al curso
        $functionname2 = 'enrol_manual_unenrol_users';
        $serverurl2 = $this->domainname
        . '?wstoken=' . $this->token
        . '&wsfunction='.$functionname2
        .'&moodlewsrestformat=json&enrolments[0][roleid]=5&enrolments[0][userid]='.$user->id_user_moodle.'&enrolments[0][courseid]='.$area->id_course_moodle;
        Http::get($serverurl2);
        }
        return redirect()->route('grado.consultar',$grado->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function edit(Grado $grado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grado $grado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grado $grado)
    {
        //
    }

    public function creargrado(Periodo $periodo)
    {
        $plantillas = Plantilla::all();
        return view('grados.create',compact('periodo','plantillas'));
    }

    public function store2(Request $request, $periodo)
    {   
        $request->validate([
            'name' => 'required',
            'plantilla_id' => 'required'
        ]);
        $plantilla = Plantilla::find($request->input('plantilla_id'));
        $periodo = Periodo::find($periodo);
        /*crear grado en moodle*/
        //declarar la función
        $functionname = 'core_course_create_categories';
        //prepar la consulta
        $consulta = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json'
        .'&categories[0][name]='.$request->input('name')
        .'&categories[0][parent]='.$periodo->id_category_moodle
        .'&categories[0][descriptionformat]=0';
        $c_categoria = Http::get($consulta);
        //$c_categoria = json_decode($c_categoria);
        foreach (json_decode($c_categoria) as $cd_categoria) {
        }
        /*crear grado en el sistema*/
        $grado = new Grado();
        $grado->name = $request->input('name');
        $grado->periodo_id = $periodo->id;
        $grado->id_category_moodle = $cd_categoria->id;
        $grado->save();
        /*Crear Cursos en moodle y en el Sistema*/
        $functionname = 'core_course_create_courses';
        foreach ($plantilla->cursos as $curso) {
            $serverurl3 = $this->domainname . '/webservice/rest/server.php'
            . '?wstoken=' . $this->token 
            . '&wsfunction='.$functionname
            .'&moodlewsrestformat=json&courses[0][fullname]='.$curso->name
            .'&courses[0][shortname]='.$periodo->name.'-'.$grado->name.'-'.$curso->name
            .'&courses[0][categoryid]='.$cd_categoria->id;
            $c_curso = Http::get($serverurl3);
            foreach (json_decode($c_curso) as $cd_curso) {
            }
            //registrar el Area en el sistema
            $n_area = new Area();
            $n_area->name = $curso->name;
            $n_area->shortname = $periodo->name.'-'.$curso->name;
            $n_area->id_course_moodle = $cd_curso->id;
            $n_area->grado_id = $grado->id;
            $n_area->save();
        }
        return redirect()->route('periodos.index')->with('info','El Grado se creo correctamente');
    }
}
