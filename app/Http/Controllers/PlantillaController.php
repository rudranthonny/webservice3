<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Grado;
use App\Models\Periodo;
use App\Models\Plantilla;
use Illuminate\Http\Request;

class PlantillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantillas = Plantilla::all();
        return view('plantillas.index',compact('plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantillas.create');
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
        $c_plantilla = new Plantilla();
        $c_plantilla->name = $request->input('name');
        $c_plantilla->save();
        return redirect()->route('plantillas.index')->with('info','la plantilla se creo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function show(Plantilla $plantilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Plantilla $plantilla)
    {
        return view('plantillas.edit',compact('plantilla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plantilla $plantilla)
    {
        //validación 
        $request->validate([
            'name' => 'required',
        ]);
        $plantilla->name = $request->input('name');
        $plantilla->save();
        return redirect()->route('plantillas.index')->with('info','la plantilla se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plantilla $plantilla)
    {
        if($plantilla->cursos->count()== 0){
        $plantilla->delete();
        return redirect()->route('plantillas.index')->with('info','la plantilla se elimino correctamente');
        }
        else{
            return redirect()->route('plantillas.index')->with('info','la plantilla no se elimino por que tiene cursos');
        }
    }

    public function store2(Request $request, Plantilla $plantilla)
    {
        $request->validate([
            'name' => 'required',
            'plantilla_id' => 'required'
        ]);
        $curso = new Curso();
        $curso->name = $request->input('name');
        $curso->plantilla_id = $plantilla->id;
        $curso->save();
        return redirect()->route('plantillas.index')->with('info','El curso se creo correctamente');
    }
}
