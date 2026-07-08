@extends('layouts.app')

@section('title', 'Editar Presença')

@section('content')
@include('presencas.form', ['action' => route('presencas.update', $presenca->id), 'method' => 'PUT', 'titulo' => 'Editar Presença', 'subtitulo' => 'Atualize os dados do registro de frequência.', 'presenca' => $presenca])
@endsection
