<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('paciente.listPacientes',compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([
            'nome'=>'required',
            'peso'=>'required|numeric',
            'altura'=>'required|numeric',
        ]);

        $request['indice_massa_corporea'] = $this->calculateIMC($request);

        Paciente::create($request->all());

        return redirect('/paciente');
    }

    public function calculateIMC(Request $request )
    {
            $valorDoImc = $request['peso'] / pow($request['altura'], 2);
            return $valorDoImc;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
        return view('paciente.show',compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);
        return view('paciente.edit',compact('paciente'));
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
        $paciente = Paciente::find($id);

        $request ->validate([
            'nome'=>'required',
            'peso'=>'required|numeric',
            'altura'=>'required|numeric',
        ]);

        $request['indice_massa_corporea'] = $this->calculateIMC($request);

        $paciente->update($request->all());
        return redirect('paciente')
                ->with('success','Paciente atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paciente::destroy($id);

        return redirect()->route('paciente')
                        ->with('success','Paciente foi removido');
    }
}
