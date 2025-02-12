<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Naox</title>
    <link rel="stylesheet" href="{{ asset('css/templates/header.css') }}">

    <link rel="shortcut icon" type="imagex/png" href="img/icon.ico">

</head>

<body>
    <nav class="navbar sticky-top navbar-expand-md">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li>
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/naox.png') }}" class="logo">
                        </a>
                    </li>
                </ul>
                <ul class="icons navbar-nav">
                    <li><a href="{{ route('clientes.index') }}"><i
                                class="material-icons">groups</i><span>Clientes</span></a></li>
                    <li><a href="{{ route('fornecedores.index') }}"><i
                                class="material-icons">local_shipping</i><span>Fornecedores</span></a></li>
                    <li><a href="{{ route('produtos.index') }}"><i
                                class="material-icons">fastfood</i><span>Produtos</span></a></li>
                    <li><a href="{{ route('ingredientes.index') }}"><i
                                class="material-icons">local_grocery_store</i><span>Ingredientes</span></a></li>
                    <li><a href="{{ route('estoque.index') }}"><i
                                class="material-icons">archive</i><span>Estoque</span></a></li>
                    <li><a href="{{ route('users.index') }}"><i
                                class="material-icons">assignment_ind</i><span>Usuários</span></a></li>
                </ul>   
            </div>
            <ul class="icons navbar-nav">
                <li><a href="{{ route('settings.settings') }}"><i class="material-icons">settings</i><span>Configurações</span></a></li>
            </ul>
        </div>
    </nav>
    @yield('conteudo')
</body>

<!-- Modal de Remoção -->
<div class="modal fade" id="removeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Operação de Remoção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeRemoveModal()"
                    aria-label="Close"></button>
            </div>
            <input type="hidden" id="id_remove">
            <div class="modal-body text-secondary"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeRemoveModal()">Não</button>
                <button type="button" class="btn btn-danger" onclick="remove()">Sim</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function formatarTelefone(telefone) {
        var digits = telefone.replace(/\D/g, '');
        return digits.length === 11 ? `(${digits.slice(0, 2)}) ${digits.slice(2, 7)}-${digits.slice(7, 11)}` :
            digits.length === 10 ? `(${digits.slice(0, 2)}) ${digits.slice(2, 6)}-${digits.slice(6, 10)}` : digits;
    }

    function formatarDocumento(documento) {
        var digits = documento.replace(/\D/g, '');
        return digits.length === 11 ? digits.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4") :
            digits.length === 14 ? digits.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") : digits;
    }

    $(document).ready(function() {
        $('#telefone').on('blur', function() {
            $(this).val(formatarTelefone($(this).val()));
        });
        $('#documento').on('blur', function() {
            $(this).val(formatarDocumento($(this).val()));
        });
    });

    function showRemoveModal(id, nome) {
        $('#id_remove').val(id);
        $('#removeModal').modal('show').find('.modal-body').html(
            `Deseja remover o registro <b class='text-danger'>'${nome}'</b> ?`);
    }

    function closeRemoveModal() {
        $('#removeModal').modal('hide');
    }

    function remove() {
        document.getElementById('form_' + $('#id_remove').val()).submit();
        closeRemoveModal();
    }
</script>

@yield('script')

</html>