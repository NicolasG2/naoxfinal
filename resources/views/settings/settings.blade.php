@extends('templates.header', ['menu' => 'admin'])

@section('titulo')
    Configurações
@endsection

@section('conteudo')
    <div class="icons">
        <ul style="list-style: none">
            <li>
                <a href="{{ route('mesas.index') }}">
                    <i class="material-icons">next_week</i>
                    <span>Gerenciador de mesas</span>
                </a>
            </li>
        </ul>
    </div>
@endsection
