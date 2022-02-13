<?php

namespace App\Http\Controllers;

use App\Models\m_pelicula;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;

class MPeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $datos['pelicula']=m_pelicula::paginate(5);
        return view('pelicula.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

return view('pelicula.create');

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

        $n_campos=[
            'nombre'=>'required|string|max:100',
            'poster'=>'required|max:10000|mimes:jpeg,png,gif,bpm,jpg',
            'duracion'=>'required|string|max:100',
            'clasificacion'=>'required|string|max:100',

        ];
        $e_mensaje=[
            'nombre.required'=>'El :attribute de la pelicula requerido',
            'poster.required'=>'Coloca el poster de tu pelicula',
            'duracion.required'=>'La :attribute de la pelicula requerida',
            'clasificacion.required'=>'La :attribute de la pelicula requerida'
        ];

        $this->validate($request, $n_campos,$e_mensaje);


       /* $datospelicula = request()->all();*/
       $datospelicula = request()->except('_token');

       if($request->hasFile('poster')){
           $datospelicula['poster']=$request->file('poster')->store('upload','public');
       }

       m_pelicula::insert($datospelicula);

        //return response()->json($datospelicula);
return redirect('pelicula')->with('mensaje','Nueva Pelicula Agregado con Éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\m_pelicula  $m_pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(m_pelicula $m_pelicula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\m_pelicula  $m_pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         
       $pelicula=m_pelicula::findOrFail($id);
        return view('pelicula.edit', compact('pelicula'));


        /*return view('pelicula.edit');*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\m_pelicula  $m_pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $n_campos=[
            'nombre'=>'required|string|max:100',
            'duracion'=>'required|string|max:100',
            'clasificacion'=>'required|string|max:100',

        ];
        $e_mensaje=[
            'nombre.required'=>'El :attribute de la pelicula requerido',
            'poster.required'=>'Coloca el poster de tu pelicula',
            'duracion.required'=>'La :attribute de la pelicula requerida',
            'clasificacion.required'=>'La :attribute de la pelicula requerida'
        ];

        if($request->hasFile('poster')){
            $n_campos=[ 'poster'=>'required|max:10000|mimes:jpeg,png,gif,bpm,jpg'];

            $e_mensaje=['poster.required'=>'Coloca el poster de tu pelicula'];
        }



        $this->validate($request, $n_campos,$e_mensaje);

        //

        $datospelicula = request()->except(['_token','_method']);

        if($request->hasFile('poster')){
        $pelicula=m_pelicula::findOrFail($id);

        Storage::delete('public/'.$pelicula->poster);

        $datospelicula['poster']=$request->file('poster')->store('uploads','public');
        }


        m_pelicula::where ('id','=',$id)->update($datospelicula) ;
        $pelicula=m_pelicula::findOrFail($id);
        /*return view('pelicula.edit', compact('pelicula') );*/

        return redirect('pelicula')->with('message','Pelicula Actualizada de la Cartelera');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\m_pelicula  $m_pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $pelicula=m_pelicula::findOrFail($id);

       if(Storage::delete('public/'.$pelicula->poster)){
        m_pelicula::destroy($id);   
       }

        return redirect('pelicula')->with('mensaje','Pelicula Borrada de la Cartelera');

    }
}
