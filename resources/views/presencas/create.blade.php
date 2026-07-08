@extends('layouts.app')

@section('title', 'Registrar Presença')

@section('content')
@include('presencas.form', ['action' => route('presencas.store'), 'method' => 'POST', 'titulo' => 'Registrar Presença', 'subtitulo' => 'Informe o aluno, data e horário de entrada.', 'presenca' => null])
@endsection
