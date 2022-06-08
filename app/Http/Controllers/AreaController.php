<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Grado;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AreaController extends Controller
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
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }

    public function consultar(Grado $grado,User $user)
    {     
        //obtener notas generales de los cursos en moodle
        $functionname = 'gradereport_overview_get_course_grades';
        $serverurl2 = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&userid='.$user->id_user_moodle;
        $notas = Http::get($serverurl2);
        //declarar un array
        $l_notas = array();
        foreach ($grado->areas as $area) {
            foreach (json_decode($notas)->grades as $nota) {
                if($area->id_course_moodle == $nota->courseid){
                    if($nota->grade == '-'){
                    $l_notas[$area->id] = 0;
                    }
                    else{   
                    $l_notas[$area->id] = $nota->grade;
                    }  
                }
            }
        }
        $grado = Grado::find($grado->id);
        return view('areas.consultar',compact('grado','user','l_notas'));
    }

    public function consultarnota(Area $area,User $user)
    { 
         //obtener notas del estudiante del curso indicado
         $functionname2 = 'gradereport_user_get_grades_table';
         $serverurl2 = $this->domainname
         . '?wstoken=' . $this->token 
         . '&wsfunction='.$functionname2
         .'&moodlewsrestformat=json&courseid='.$area->id_course_moodle.'&userid='.$user->id_user_moodle;
         $consulta = Http::get($serverurl2);
         //return  $serverurl2;
        return view('areas.consultarnota',compact('area','user','consulta'));
    }
    public function consultarnotapdf(Area $area,User $user)
    {
        //obtener notas del estudiante del curso indicado
        $functionname2 = 'gradereport_user_get_grades_table';
        $serverurl2 = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname2
        .'&moodlewsrestformat=json&courseid='.$area->id_course_moodle.'&userid='.$user->id_user_moodle;
        $consulta = Http::get($serverurl2);
         //generar pdf
         $pdf = PDF::loadView('areas.consultapdf',compact('consulta'));
         return $pdf->download("ficha-reporte-notas.pdf");
    }
    /*-----------------*/
    public function reiniciar(Area $area){
        $functionname2 = 'core_course_delete_modules ';
        $consulta = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname2
        .'&moodlewsrestformat=json&cmids[0]='.$area->id_course_moodle;
        return $consulta;
        $consulta = Http::get($consulta);
    }
}
