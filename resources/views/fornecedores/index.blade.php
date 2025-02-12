@extends('templates.header', ['menu' => 'admin', 'submenu' => 'Fornecedores', 'rota' => "fornecedores.create",])

@section('titulo') Fornecedores @endsection

@section('conteudo')
<link rel="stylesheet" href="{{asset('../css/fornecedores/index.css')}}">

    <div class="row">
        <div class="col">
            <table class="tabela_fornecedor table align-middle caption-top table-striped">
                <caption><b>Fornecedores</b>
                    <a href="{{ route('fornecedores.create') }}" class="btn-edit btn btn-primary ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                    </a> 
                </caption>
                <thead>
                    <tr id="tr1">
                        <th scope="col">NOME</th>
                        <th scope="col">DOCUMENTO</th>
                        <th scope="col">TELEFONE</th>
                        <th scope="col">ATIVO</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">ENDEREÇO</th>
                        <th scope="col">DESCRICAO</th>
                        <th scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fornecedores as $item)
                        <tr>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->documento }}</td>
                            <td>{{ $item->telefone }}</td>
                            @if($item->ativo == 1)
                                <td>Sim</td>
                            @endif
                            @if($item->ativo == 0)
                                <td>Não</td>
                            @endif
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->endereco }}</td>      
                            <td>{{ $item->descricao }}</td>
                            <td>
                            <a href="{{ route('fornecedores.edit', $item['id']) }}" class="btn-edit btn">
                                    <img src="https://www.svgrepo.com/show/418008/edit.svg" alt="Editar" width="25px"
                                        height="25px">
                                </a>

                                <a nohref style="cursor:pointer" onclick="showRemoveModal('{{ $item['id'] }}')"
                                    class="btn-delete btn">
                                    <img src="https://www.svgrepo.com/show/289491/delete-stop.svg" alt="Delete" width="25px"
                                        height="25px">
                                </a>
                            </td>
                            <form action="{{ route('fornecedores.destroy', $item->id) }}" method="POST"
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
@endsection