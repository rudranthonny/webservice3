<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Grado;
use App\Models\Plantilla;
use App\Models\User;
use Illuminate\Http\Request;

class CursoController extends Controller
{
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
        $plantillas = Plantilla::all();
        return view('cursos.create',compact('plantillas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('plantillas.index')->with('info','El curso se elimino correctamente');
    }
    public function destroy2(Curso $curso,Plantilla $plantilla)
    {
        $curso->delete();
        return redirect()->route('curso.crearcurso',$plantilla->id)->with('info','El curso se elimino correctamente');
    }

    public function crearcurso(Plantilla $plantilla)
    {

        return view('cursos.create',compact('plantilla'));
    }

    public function store2(Request $request, Plantilla $plantilla)
    {
        $request->validate([
            'name' => 'required',
            'plantilla_id' => 'required'
        ]);
        $curso = new Curso();
        $curso->plantilla_id = $request->input('plantilla_id');
        $curso->name = $request->input('name');
        $curso->save();
        return redirect()->route('plantillas.index')->with('info','El curso se creo correctamente');
    }

}
