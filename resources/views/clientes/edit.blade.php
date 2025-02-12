@extends('templates.header', ['menu' => 'admin', 'submenu' => 'Alterar Cliente', 'rota' => 'clientes.create'])

@section('titulo')
Clientes
@endsection

@section('conteudo')
<link rel="stylesheet" href="{{ asset('../css/clientes/edit.css') }}">

<form action="{{ route('clientes.update', $clientes->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <caption><b>Edição de Cliente</b></caption>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @if ($errors->has('nome')) is-invalid @endif" name="nome"
                        placeholder="nome" value="{{ $clientes->nome }}" />
                    <label for="nome">Nome</label>
                    @if ($errors->has('nome'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('nome') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @if ($errors->has('comentario')) is-invalid @endif"
                        name="comentario" placeholder="Comentário" value="{{ $clientes->comentario }}" />
                    <label for="comentario">Comentário</label>
                    @if ($errors->has('comentario'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('comentario') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="tel" inputmode="numeric"
                        class="form-control @if ($errors->has('telefone')) is-invalid @endif" autocomplete="tel"
                        placeholder="(99) 99999-9999" name="telefone" id="telefone"
                        oninput="formatarTelefone(this.value)" value="{{ $clientes->telefone }}" />
                    <label for="telefone">Telefone</label>
                    @if ($errors->has('telefone'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('telefone') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" inputmode="numeric" class="form-control @if ($errors->has('desconto')) is-invalid @endif"
                        name="desconto" placeholder="Desconto" value="{{ $clientes->desconto }}" />
                    <label for="desconto">Desconto</label>
                    @if ($errors->has('desconto'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('desconto') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('clientes.index') }}" class="btn-voltar btn btn-block align-content-center">
                    <img src="https://www.svgrepo.com/show/422335/back-mp3-music.svg" alt="Voltar" width="25px"
                        height="25px">
                    &nbsp; Voltar
                </a>
                <a href="javascript:document.querySelector('form').submit();"
                    class="btn-confirm btn btn-block align-content-center">
                    Confirmar &nbsp;
                    <img src="https://www.svgrepo.com/show/218203/confirm.svg" alt="Confirmar" width="25px" height="25px">
                </a>

            </div>
        </div>
    </div>

    @endsection