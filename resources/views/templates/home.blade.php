@extends('templates.header', ['menu' => 'admin'])

@section('conteudo')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/templates/home.css') }}">

    <div class="main">
        <div class="col-md-7">
            <div class="areas">
                <button class="mesas-button"><span>Mesas</span></button>
                <button><span>Balcão</span></button>
                <button><span>Delivery</span></button>
                <button><span>Cozinha</span></button>
            </div>
            <div class="ambiente">
                <button class="interna-button"><span>Área interna</span></button>
                <button><span>Área externa</span></button>
            </div>
            <div class="grid-container" id="grid-container">
                @foreach ($mesas as $mesa)
                    <div class="grid-item" id="mesa-{{ $mesa->id }}" data-mesa-id="{{ $mesa->id }}"
                        data-mesa-numero="{{ $mesa->numero }}"
                        onclick="showMesaDetails({{ $mesa->id }}, {{ json_encode($mesa) }})">
                        {{ $mesa->numero }}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col">
            <div class="search-area">
                <i class="material-icons">search</i><input type="search" id="gsearch" name="gsearch"
                    placeholder="Buscar mesa">
            </div>
            <div class="mesa-header" id="mesa-header">
                <span class="" id="mesa-header-text">Mesa <span id="mesa-number">--</span></span>
                <i class="material-icons" id="mesa-header-icon" onclick="closeMesaDetails()">close</i>
            </div>
            <div class="mesa-body justify-content-center align-items-center">
                <div class="col-md-5 d-flex ml-3">
                    <div id="mesa-details" class="text-center w-100">
                        <h6><-- Selecione uma mesa</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const clientes = @json($clientes);
        const atendentes = @json($users);
        const produtos = @json($produtos);
        let id_mesa_global;
        let id_pedido_atual;

        function showMesaDetails(id_mesa, mesa) {
            id_mesa_global = id_mesa;
            const detailsDiv = document.getElementById('mesa-details');
            const mesaHeader = document.getElementById('mesa-header');
            const mesaNumber = document.getElementById('mesa-number');

            mesaHeader.classList.add('active');
            mesaNumber.textContent = mesa.numero;

            hideAllComponents();

            let clientesOptions = '<option value="">Selecione um cliente</option>';
            clientes.forEach(cliente => {
                clientesOptions += `<option value="${cliente.id}">${cliente.nome}</option>`;
            });

            let atendentesOptions = '<option value="">Selecione um atendente</option>';
            atendentes.forEach(atendente => {
                atendentesOptions += `<option value="${atendente.id}">${atendente.nome}</option>`;
            });

            detailsDiv.innerHTML = `
                <h3>Mesa ${mesa.numero}</h3>
                <div class="d-flex">
                    <p><strong>Número de pessoas:</strong></p>
                    <div class="stat-minus"><i class="material-icons" alt="Minus">exposure_neg_1</i></div>
                    <input id="num_pessoas" type="number" value="1" min="1" max="12" />
                    <div class="stat-plus"><i class="material-icons" alt="Plus">exposure_plus_1</i></div>
                </div>
                <div class="d-flex">
                    <p><strong>Cliente:</strong></p>
                    <select class="form-control" name="cliente" id="cliente-select">${clientesOptions}</select>
                </div>
                <div class="d-flex">
                    <p><strong>Atendente:</strong></p>
                    <select class="form-control" name="atendente" id="user-select">
                    <option>Selecione um atendente</option>
                    <option>Admin User</option>    
                    <option>Carlos Souza</option>
                    <option>Nicolas</option>    
                    <option>Regular User</option>
                    </select>
                </div>
                <div class="d-flex">
                    <p><strong>Comentário:</strong></p>
                    <textarea name="comentario" id="comentario" cols="30" rows="5"></textarea>
                </div>
                <button class="btn btn-info" onclick="sla()">Abrir Mesa</button>
            `;

            document.querySelector('.stat-plus').addEventListener('click', function() {
                const numberInput = document.getElementById('num_pessoas');
                let currentValue = parseInt(numberInput.value);
                if (currentValue < numberInput.max) {
                    numberInput.value = currentValue + 1;
                }
            });

            document.querySelector('.stat-minus').addEventListener('click', function() {
                const numberInput = document.getElementById('num_pessoas');
                let currentValue = parseInt(numberInput.value);
                if (currentValue > numberInput.min) {
                    numberInput.value = currentValue - 1;
                }
            });
        }

        function sla() {
            const detailsDiv = document.getElementById('mesa-details');

            hideAllComponents();

            detailsDiv.innerHTML = `
                <div class="col">
                    <div class="row">
                        <div class="d-flex">
                            <p><strong>Número de pessoas: 3</strong></p>
                        </div>
                        <div class="d-flex">
                            <p><strong>Cliente: João Silva</strong></p>
                        </div>
                        <div class="d-flex">
                            <p>Atendente: Nicolas</p>
                        </div>
                    </div>
                    <div>
                        <p><strong>ADICIONAR PRODUTO</strong></p>
                    </div>
                    <div class="row" style="justify">
                        <a href="{{ route('produtos.show') }}" class="btn-edit btn btn-primary ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </a>  
                        <div class="search-area">
                            <i class="material-icons">search</i><input type="search" id="gsearch" name="gsearch" placeholder="Buscar produto">
                        </div>
                    </div>
                    <div class="d-flex">
                        <span></span>
                    </div>
                    <button class="btn btn-info" onclick="fecharMesa()">Fechar Mesa</button>
                </div>
            `;
        }

        function atualizarNomes() {
            const clienteId = document.getElementById('cliente-select').value;
            const userID = document.getElementById('user-select').value;

            const clienteNome = clienteId ? clientes.find(c => c.id == clienteId)?.nome : 'Não selecionado';
            const userNome = userID ? atendentes.find(u => u.id == userID)?.nome : 'Não selecionado';

            const detailsDiv = document.getElementById('mesa-details');
            const rowElement = detailsDiv.querySelector('.row');

            if (rowElement) {
                rowElement.innerHTML = `
                    <span>Pessoas na mesa: ${document.getElementById('num_pessoas').value}; </span>
                    <span>Cliente: ${clienteNome}; </span>
                    <span>Atendente: ${userNome}; </span>
                `;
            } else {
                console.warn('The .row element was not found.');
            }
        }

        function renderPedidoArea(id_mesa, data) {
            console.log('Dados recebidos em renderPedidoArea:', data);

            let id_pedido_atual = data.id;
            const detailsDiv = document.getElementById('mesa-details');
            console.log('Data received in renderPedidoArea:', data);

            const itensDePedido = data.itens_de_pedido || [];
            const valor_total_pedido = data.valor_total_pedido || 0;

            const clienteSelect = document.getElementById('cliente-select');
            const clienteId = clienteSelect ? clienteSelect.value : '';
            const cliente_desconto = clienteId ? clientes.find(c => c.id == clienteId)?.desconto : 0;
            const clienteNome = clienteId ? clientes.find(c => c.id == clienteId)?.nome : 'Não selecionado';

            const userSelect = document.getElementById('user-select');
            const userID = userSelect ? userSelect.value : '';
            const userNome = userID ? atendentes.find(u => u.id == userID)?.nome : 'Não selecionado';

            const quantidadeElement = document.getElementById('quantidade');
            const quantidade = quantidadeElement ? quantidadeElement.value : 1;

            const horarioAbertura = data.horario_abertura ? data.horario_abertura : 'Horário não disponível';

            let secaoDesconto = '';
            let produtosOptions = '<option value="">Selecione um produto</option>';
            produtos.forEach(produto => {
                produtosOptions += `<option value="${produto.id}">${produto.nome}</option>`;
            });

            const pedidosHtml = itensDePedido.length > 0 ? itensDePedido.map(item => `
                <tr>
                    <td>${item.quantidade}</td>
                    <td>${item.produto.nome}</td>
                    <td>R$${item.valor}</td>
                </tr>
            `).join('') : '<tr><td colspan="3">Nenhum produto adicionado.</td></tr>';

            if (cliente_desconto > 0) {
                const discountedTotal = (valor_total_pedido - (valor_total_pedido * (cliente_desconto / 100))).toFixed(2);
                secaoDesconto = `
                    <tr>
                        <td>Desconto: ${cliente_desconto.toFixed(2)}%</td>
                        <td>Subtotal: R$${discountedTotal}</td>
                    </tr>
                `;
            } else {
                secaoDesconto = `<tr><td>Total: R$${valor_total_pedido.toFixed(2)}</td></tr>`;
            }

            detailsDiv.innerHTML = `
                <h3>Mesa ${id_mesa}</h3>
                <div class="row">
                    <span>Pessoas na mesa: ${data.num_pessoas}; </span>
                    <span>Cliente: ${clienteNome}; </span>
                    <span>Atendente: ${userNome}; </span>
                    <span>Horário de abertura: ${horarioAbertura}</span>
                    <span>Status: ${data.status}</span> <!-- Exibe o status -->
                </div>
                <div class="d-flex flex-column" style="max-height: 300px; overflow-y: auto;">
                    <div class="d-flex">
                        <p><strong>Produto:</strong></p>
                        <select class="form-control" name="produto" id="produto-select">
                            ${produtosOptions}
                        </select>
                        <input type="number" id="quantidade" value="1" min="1" max="12" style="width: 60px; margin-left: 10px;">
                        <button class="btn btn-success ml-2" onclick="adicionarProduto(${id_mesa}, ${id_pedido_atual})">Adicionar Produto</button>
                    </div>
                    <div style="max-height: 300px; overflow-y: auto;">
                        <h4>Produtos Adicionados:</h4>
                        <table class="table">
                            <tbody id="itens-pedido-tbody">
                                ${pedidosHtml}
                                ${secaoDesconto}
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary mt-3" onclick="finalizarPedido(${id_mesa})">Finalizar Pedido</button>
                </div>
            `;
        }

        function adicionarProduto(id_mesa) {
            const produtoSelect = document.getElementById('produto-select');
            const quantidade = document.getElementById('quantidade').value;

            if (!produtoSelect.value || !quantidade) {
                alert('Por favor, preencha todos os campos.');
                return;
            }

            fetch(`/pedidos/${id_pedido_atual}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_mesa: id_mesa,
                        id_produto: produtoSelect.value,
                        quantidade: quantidade,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Produto adicionado. Dados retornados:', data);
                    atualizarDadosPedido(id_mesa);
                })
                .catch(error => console.error('Erro ao adicionar produto:', error));
        }

        function atualizarDadosPedido(id_mesa) {
            fetch(`/pedido/detalhes/${id_mesa}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dados atualizados do pedido:', data);
                    renderPedidoArea(id_mesa, data);
                })
                .catch(error => console.error('Erro ao atualizar dados do pedido:', error));
        }

        function finalizarPedido(id_mesa) {
            fetch(`/pedidos/${id_pedido_atual}/finalizar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_mesa
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao finalizar pedido.');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Pedido finalizado com sucesso:', data);
                    location.reload();
                })
                .catch(error => console.error('Erro durante a requisição:', error));
        }

        function abrirMesa(id_mesa) {
            const numPessoas = document.getElementById('num_pessoas').value;
            const clienteId = document.getElementById('cliente-select').value;
            const userID = document.getElementById('user-select').value;
            const comentario = document.getElementById('comentario').value;

            fetch(`/pedidos/${id_mesa}/abrir`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        num_pessoas: numPessoas,
                        cliente_id: clienteId,
                        user_id: userID,
                        comentario: comentario
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Mesa aberta com sucesso');
                        renderPedidoArea(id_mesa, data);
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => console.error('Erro ao abrir mesa:', error));
        }

        function fecharMesa() {
            hideAllComponents();
        }

        function hideAllComponents() {
            const mesaDetails = document.getElementById('mesa-details');
            mesaDetails.innerHTML = '';
        }
    </script>
@endsection
