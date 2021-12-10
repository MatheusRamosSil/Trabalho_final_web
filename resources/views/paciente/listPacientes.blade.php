@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tabela de pacientes</h2>
            </div>
            <div class="pull-right">
                <br></br>
                 <a class="btn btn-success" href="{{ route('create') }}">Adicionar novo paciente</a>
                 <br></br>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
          <td>ID</td>
          <td>Nome</td>
          <td>Idade</td>
          <td>Peso</td>
          <td>Altura</td>
          <td>IMC</td>
          <td colspan = 2>Actions</td>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{$paciente->id}}</td>
            <td>{{$paciente->nome}}</td>
            <td>{{$paciente->idade}}</td>
            <td>{{$paciente->peso}}</td>
            <td>{{$paciente->altura}}</td>
            <td>{{$paciente->indice_massa_corporea}}</td>
            <td>
         
                <form action="{{ route('destroy', $paciente->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('show', $paciente->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('edit', $paciente->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>      
@endsection
