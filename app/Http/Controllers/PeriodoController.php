<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeriodoController extends Controller
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
        $periodos = Periodo::all();
        return view('periodos.index',compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periodos.create');
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
        ]);
        /*crear categoria en el moodle*/
        //declarar la función
        $functionname = 'core_course_create_categories';
        //prepar la consulta
        $consulta = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json'
        .'&categories[0][name]='.$request->input('name')
        .'&categories[0][parent]=0'
        .'&categories[0][descriptionformat]=0';
        $c_categoria = Http::get($consulta);
        //$c_categoria = json_decode($c_categoria);
        foreach (json_decode($c_categoria) as $cd_categoria) {
        }
        /*crear categoria en el sistema*/
        $c_periodo = new Periodo();
        $c_periodo->name = $request->input('name');
        $c_periodo->id_category_moodle = $cd_categoria->id;;
        $c_periodo->save();
        return redirect()->route('periodos.index')->with('info','el periodo se creo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show(Periodo $periodo)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodo $periodo)
    {
        return view('periodos.edit',compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodo $periodo)
    {
        //validación 
        $request->validate([
            'name' => 'required',
        ]);
        /**actualizar en moodle**/
        //declarar la función
        $functionname = 'core_course_update_categories';
        //prepar la consulta
        $consulta = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json'
        .'&categories[0][id]='.$periodo->id_category_moodle
        .'&categories[0][name]='.$request->input('name')
        .'&categories[0][descriptionformat]=0';
        //ejecutar consulta
        Http::get($consulta);
        /*actualizar en el Sistema*/
        $periodo->name = $request->input('name');
        $periodo->save();
        return redirect()->route('periodos.index')->with('info','el periodo se Actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
         //eliminar la categoria en el moodle
        //declarar la función
        $functionname = 'core_course_delete_categories';
        //prepar la consulta
        $consulta = $this->domainname
        . '?wstoken=' . $this->token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json'
        .'&categories[0][id]='.$periodo->id_category_moodle
        .'&categories[0][newparent]=0'
        .'&categories[0][recursive]=1';
        //ejecutar laconsulta
        $d_categoria = Http::get($consulta);
        //eliminar la categoria en el sistema
        $periodo->delete();
        //retornar vista
        return redirect()->route('periodos.index')->with('info','El periodo se elimino correctamente');
    }
}
