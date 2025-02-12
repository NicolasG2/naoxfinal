@php $checked = true; @endphp

@extends('templates.header', ['menu' => 'admin', 'submenu' => 'Alterar Fornecedor', 'rota' => 'fornecedores.create'])

@section('titulo')
    Fornecedores
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('../css/fornecedores/edit.css') }}">

    <form action="{{ route('fornecedores.update', $fornecedores->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <caption><b>Edição de Fornecedor</b></caption>
        <div class="container">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @if ($errors->has('nome')) is-invalid @endif"
                        name="nome" placeholder="nome" value="{{ $fornecedores->nome }}" />
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
                    <input type="text" inputmode="numeric" autocomplete="cc-number"
                        class="form-control @if ($errors->has('documento')) is-invalid @endif" name="documento"
                        id="documento" placeholder="CPF ou CNPJ" oninput="formatarDocumento(this.value)"
                        value="{{ $fornecedores->documento }}" />
                    <label for="documento">Documento</label>
                    @if ($errors->has('documento'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('documento') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" inputmode="numeric"
                        class="form-control @if ($errors->has('telefone')) is-invalid @endif" autocomplete="tel"
                        placeholder="(99) 99999-9999" name="telefone" id="telefone" oninput="formatarTelefone(this.value)"
                        value="{{ $fornecedores->telefone }}" />
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
                    <input type="text" class="form-control @if ($errors->has('descricao')) is-invalid @endif"
                        name="descricao" placeholder="Descrição" value="{{ $fornecedores->descricao }}" />
                    <label for="descricao">Descrição</label>
                    @if ($errors->has('descricao'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('descricao') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @if ($errors->has('email')) is-invalid @endif"
                        name="email" placeholder="E-mail" id="documento" oninput="formatarDocumento(this.value)"
                        value="{{ $fornecedores->email }}" />
                    <label for="email">E-mail</label>
                    @if ($errors->has('email'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @if ($errors->has('endereco')) is-invalid @endif"
                        name="endereco" placeholder="Endereço" value="{{ $fornecedores->endereco }}" />
                    <label for="endereco">Endereço</label>
                    @if ($errors->has('endereco'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('endereco') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <div class="form-check">
                        <input type="checkbox" id="ativo" class="form-check-input"
                            @if ($errors->has('ativo')) is-invalid @endif
                            @if ($checked) checked @endif value="1" name="ativo">
                        <label class="form-check-label" for="ativo">Ativo</label>
                    </div>
                    <input type="hidden" name="ativo" value="0">
                    @if ($errors->has('ativo'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('ativo') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('fornecedores.index') }}" class="btn-voltar btn btn-block align-content-center">
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
