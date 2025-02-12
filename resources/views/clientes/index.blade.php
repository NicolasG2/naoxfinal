@extends('templates.header', ['menu' => 'admin', 'submenu' => 'Cliente', 'rota' => "clientes.create",])

@section('titulo') Clientes @endsection

@section('conteudo')
<link rel="stylesheet" href="{{asset('../css/clientes/index.css')}}">

<div class="row">
    <div class="col">
        <div class="container">
            <table class="tabela_cliente table align-middle caption-top table-striped">
                <caption>
                    <b>Clientes</b>
                    <a href="{{ route('clientes.create') }}" class="btn-edit btn btn-primary ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                    </a>    
                </caption>             
                <thead>
                    <tr id="tr1">
                        <th scope="col">NOME</th>
                        <th scope="col">COMENTÁRIO</th>
                        <th scope="col">TELEFONE</th>
                        <th scope="col">DESCONTO</th>
                        <th scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $item)
                        <tr>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->comentario }}</td>
                            <td>{{ $item->telefone }}</td>
                            <td>{{ $item->desconto }}</td>
                            <td>
                                <a href="{{ route('clientes.edit', $item['id']) }}" class="btn-edit btn">
                                    <img src="https://www.svgrepo.com/show/418008/edit.svg" alt="Editar" width="25px"
                                        height="25px">
                                </a>

                                <a nohref style="cursor:pointer" onclick="showRemoveModal('{{ $item['id'] }}')"
                                    class="btn-delete btn">
                                    <img src="https://www.svgrepo.com/show/289491/delete-stop.svg" alt="Delete" width="25px"
                                        height="25px">
                                </a>
                            </td>
                            <form action="{{ route('clientes.destroy', $item->id) }}" method="POST"
                                id="form_{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection