@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Produtos</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos_data as $produto)
                <tr>
                    <td>{{ $produto['id'] }}</td>
                    <td>{{ $produto['nome'] }}</td>
                    <td>R$ {{ number_format($produto['preco'], 2, ',', '.') }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" 
                                onclick="showProduto({{ $produto['id'] }})">
                            Visualizar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="produtoModal" tabindex="-1" aria-labelledby="produtoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produtoModalLabel">Detalhes do Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detalhes do produto serão carregados dinamicamente -->
                <div id="produtoDetalhes">
                    <p>Carregando...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showProduto(id) {
        // Faz uma requisição AJAX para buscar os detalhes do produto
        fetch(`/produtos/${id}`)
            .then(response => {
                if (!response.ok) throw new Error('Produto não encontrado!');
                return response.json();
            })
            .then(data => {
                // Preenche o modal com os dados do produto
                const detalhes = `
                    <p><strong>ID:</strong> ${data.id}</p>
                    <p><strong>Nome:</strong> ${data.nome}</p>
                    <p><strong>Preço:</strong> R$ ${parseFloat(data.preco).toFixed(2).replace('.', ',')}</p>
                    <p><strong>Quantidade:</strong> ${data.quantidade}</p>
                    <p><strong>Descrição:</strong> ${data.descricao || 'Sem descrição'}</p>
                    <p><strong>Categoria:</strong> ${data.categoria_produto?.nome || 'Não informado'}</p>
                    <p><strong>Fornecedor:</strong> ${data.fornecedor?.nome || 'Não informado'}</p>
                    <p><strong>Ingredientes:</strong> ${
                        data.ingredientes?.map(ing => ing.nome).join(', ') || 'Nenhum ingrediente'
                    }</p>
                    ${
                        data.foto 
                        ? `<img src="/storage/${data.foto}" alt="Foto do produto" class="img-fluid" />`
                        : `<p>Sem foto disponível.</p>`
                    }
                `;
                document.getElementById('produtoDetalhes').innerHTML = detalhes;
                // Abre o modal
                const modal = new bootstrap.Modal(document.getElementById('produtoModal'));
                modal.show();
            })
            .catch(error => {
                document.getElementById('produtoDetalhes').innerHTML = `<p class="text-danger">${error.message}</p>`;
            });
    }
</script>
@endsection
