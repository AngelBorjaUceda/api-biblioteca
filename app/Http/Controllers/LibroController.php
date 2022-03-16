<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Libro::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['titulo'=> 'required|min:2|max:75',
                    'descripcion'=>'required|min:2|max:250'
                ];
        
                //Completar luego
                $messages = ['required'=>'El campo :attribute está vacío.',
                            'titulo.min'=>'El campo :attribute tiene menos de 2 caracteres.',
                            'titulo.max'=>'El campo :attribute tiene mas de 75 caracteres.',
                            'descripcion.min'=>'El campo :attribute tiene menos de 2 caracteres.',
                            'descripcion.max'=>'El campo :attribute tiene mas de 250 caracteres.',
                        ];
                $validatedData = $request->validate($rules, $messages);
                $libro = Libro::create($validatedData);
                return $this->showOne($libro, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        return $this->showOne($libro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return $this->showOne($libro);
    }
}
