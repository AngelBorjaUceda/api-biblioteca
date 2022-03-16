<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Usuario::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['nombre'=> 'required|min:2|max:75',
        'email'=>'required|email|unique:usuarios,email',
        'password' => 'required|min:8'
    ];

    //Completar luego
    $messages = ['required'=>'El campo :attribute está vacío',
    'nombre.min'=>'El campo :attribute tiene menos de 2 caracteres.',
    'nombre.max'=>'El campo :attribute tiene mas de 75 caracteres.',
    'password.min'=>'El campo :attribute tiene menos de 8 caracteres.'];
    
    $validatedData = $request->validate($rules, $messages);
    $validatedData['password']=bcrypt($validatedData['password']);
    $usuario = Usuario::create($validatedData);
    return $this->showOne($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return $this->showOne($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $rules = ['nombre'=> 'min:2|max:75',
        'email'=>['email',Rule::unique('usuarios')->ignore($usuario->id)],
        'password' => 'min:8'
    ];

    //Completar luego
    $messages = ['required'=>'El campo :attribute está vacío'];
    $validatedData = $request->validate($rules, $messages);

    if ($request->filled('password')){
        $validatedData['password']=bcrypt($validatedData['password']);
    }
    $usuario->fill($validatedData);

    if(!$usuario->isDirty()){
        return response()->json(['error'=>['code'=>422,'message'=>'Ponga un valor diferente.']],422);
    }

    $usuario->save();
    return $this->showOne($usuario, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return $this->showOne($usuario);
    }
}
