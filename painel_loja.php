<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Try Systems</title>
    <style>
        body {
            background-color: #b6d9c6;
        }

        .sidebar {
            background-color: #064F24;
            min-height: 100vh;
            width: 350px;
        }

        .btn-custom {
            background-color: #064F24;
            color: white;
            width: 100%;
            margin-bottom: 10px;
        }

        .grid-item {
            background-color: #064F24;
            border: 2px solid white;
            color: white;
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            text-align: center;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .grid-item:hover {
            background-color: #026016;
        }

        .grid-item-free {
            background-color: #28a745;
        }

        .grid-item-occupied {
            background-color: #dc3545;
        }

        .grid-item-reserved {
            background-color: #007bff;
        }

        .legend {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 0 10px;
        }

        .legend-icon {
            width: 30px;
            height: 30px;
            margin-right: 5px;
            line-height: 30px;
            font-size: 14px;
        }

        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
        }
    </style>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="sidebar d-flex flex-column p-4">
                <h1 class="text-white mb-4">Try Systems</h1>
                <button class="btn btn-custom" data-toggle="modal" data-target="#gestaoMesasModal">GESTÃO DE MESAS</button>
                <button class="btn btn-custom" id="pedidoPagamentoButton">PEDIDOS E PAGAMENTOS</button>
                <button class="btn btn-custom" data-toggle="modal" data-target="#estoqueModal">GESTÃO DE ESTOQUE</button>
                <button class="btn btn-custom">GESTÃO DE FUNCIONÁRIOS</button>
                <button class="btn btn-custom">RELATÓRIOS E ANÁLISES</button>
                <button class="btn btn-custom">GESTÃO DE PROMOÇÕES</button>
                <button class="btn btn-custom">GESTÃO DE DELIVERY E TAKEOUT</button>
                <button class="btn btn-custom">CONTROLE DE CUSTOS</button>
                <button class="btn btn-custom">ADMINISTRAÇÃO E CONFIGURAÇÕES</button>
                <button class="btn btn-custom mt-auto" id="logoutButton">Logout</button>

            </div>

            <div class="legend">
                <div class="legend-item">
                    <div class="grid-item grid-item-free legend-icon"></div> Livre
                </div>
                <div class="legend-item">
                    <div class="grid-item grid-item-occupied legend-icon"></div> Ocupada
                </div>
                <div class="legend-item">
                    <div class="grid-item grid-item-reserved legend-icon"></div> Reservada
                </div>
            </div>

            <div id="toast-container">
                <div class="toast" id="confirmation-toast" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto">Notificação</strong>
                        <small>Agora</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        <span id="mesa-detail">Mesa X</span> - <span id="opcao-detail">Opção Y</span> selecionada!
                    </div>
                </div>
            </div>

            <div class="modal fade" id="rodizioModal" tabindex="-1" role="dialog" aria-labelledby="rodizioModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rodizioModalLabel">Opções de Rodizio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex flex-column align-items-center">
                            <button class="btn btn-custom mb-2 rodizio-option">RODIZIO COMPLETO</button>
                            <button class="btn btn-custom mb-2 rodizio-option">RODIZIO SIMPLES</button>
                            <button class="btn btn-custom mb-2 rodizio-option">RODIZIO BUSINESS</button>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-custom" data-dismiss="modal">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <h6>Resumo dos Pedidos:</h6>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID do Pedido</th>
                            <th>Item</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody id="pedidoTableBody">
                    </tbody>
                </table>
                <button class="btn btn-sm btn-info" id="atualizarPedidos">Atualizar Pedidos</button>
            </div>


            <div class="modal fade" id="gestaoMesasModal" tabindex="-1" role="dialog" aria-labelledby="gestaoMesasModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="gestaoMesasModalLabel">Gestão de Mesas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex flex-wrap justify-content-center">
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <div class="grid-item m-2" data-toggle="modal" data-target="#mesaModal<?= $i ?>">
                                    MESA <?= $i ?>
                                </div>

                                <div class="modal fade" id="mesaModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="mesaModal<?= $i ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mesaModal<?= $i ?>Label">Opções para a Mesa <?= $i ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body d-flex flex-column align-items-center">
                                                <button class="btn btn-custom mb-2">RODIZIO</button>
                                                <button class="btn btn-custom mb-2">A LA CARTE</button>
                                                <button class="btn btn-custom mb-2">POR KILO</button>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-custom">Confirmar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="estoqueModal" tabindex="-1" aria-labelledby="estoqueModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="estoqueModalLabel">Controle de Estoque</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Itens em Estoque:</h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome do Item</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="estoqueTableBody">
                            <!-- Os itens serão inseridos aqui via JavaScript -->
                        </tbody>
                    </table>

                    <hr>

                    <h6>Adicionar/Atualizar Item:</h6>
                    <form id="estoqueForm">
                        <div class="form-group">
                            <label for="itemName">Nome do Item</label>
                            <input type="text" class="form-control" id="itemName" required>
                        </div>
                        <div class="form-group">
                            <label for="itemQuantity">Quantidade</label>
                            <input type="number" class="form-control" id="itemQuantity" required>
                        </div>
                        <div class="form-group">
                            <label for="itemPrice">Preço</label>
                            <input type="number" step="0.01" class="form-control" id="itemPrice" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const pedidosSimulados = [{
                id: 1,
                item: 'Pizza',
                quantidade: 2,
                preco: 50
            },
            {
                id: 2,
                item: 'Hamburguer',
                quantidade: 1,
                preco: 20
            },
            {
                id: 3,
                item: 'Refrigerante',
                quantidade: 3,
                preco: 15
            }
        ];

        function atualizarTabelaPedidos() {
            const tbody = document.getElementById('pedidoTableBody');
            tbody.innerHTML = '';

            for (let pedido of pedidosSimulados) {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${pedido.id}</td>
                <td>${pedido.item}</td>
                <td>${pedido.quantidade}</td>
                <td>${pedido.preco}</td>
            `;
                tbody.appendChild(tr);
            }
        }

        document.getElementById('atualizarPedidos').addEventListener('click', atualizarTabelaPedidos);

        $('#pedidoPagamentoModal').on('shown.bs.modal', function() {
            atualizarTabelaPedidos();
        });

        document.getElementById('pedidoPagamentoButton').addEventListener('click', function() {
            $('#pedidoPagamentoModal').modal('show');
        });

        document.getElementById('logoutButton').addEventListener('click', function() {
            window.location.href = "validacao_login.php";
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.modal-body .btn-custom.mb-2').forEach(btn => {
                btn.addEventListener('click', function() {
                    btn.closest('.modal-body').querySelectorAll('.btn-custom.mb-2').forEach(otherBtn => {
                        otherBtn.classList.remove('active');
                    });
                    btn.classList.add('active');
                });
            });

            document.querySelectorAll('.modal-footer .btn-custom:not([data-dismiss="modal"])').forEach(btn => {
                btn.addEventListener('click', function() {
                    let modalContent = btn.closest('.modal-content');
                    let mesaName = modalContent.querySelector('.modal-title').textContent.split(" ")[3];
                    let selectedOption = modalContent.querySelector('.modal-body .btn-custom.mb-2.active');

                    if (selectedOption) {
                        let opcaoName = selectedOption.textContent;
                        document.getElementById('mesa-detail').textContent = 'Mesa ' + mesaName;
                        document.getElementById('opcao-detail').textContent = opcaoName;
                        $('#confirmation-toast').toast('show');
                    } else {
                        alert('Por favor, selecione uma opção para a mesa!');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.modal-body .btn-custom.mb-2').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (btn.textContent === "RODIZIO") {
                        $('#rodizioModal').modal('show');
                    } else {}
                });
            });

            document.querySelectorAll('.rodizio-option').forEach(btn => {
                btn.addEventListener('click', function() {
                    btn.closest('.modal-body').querySelectorAll('.rodizio-option').forEach(otherBtn => {
                        otherBtn.classList.remove('active');
                    });
                    btn.classList.add('active');
                    $('#rodizioModal').modal('hide');
                });
            });
        });

        const estoqueSimulado = [{
                nome: 'Tomate',
                quantidade: 50,
                preco: 3
            },
            {
                nome: 'Queijo',
                quantidade: 20,
                preco: 10
            },
            {
                nome: 'Pão',
                quantidade: 100,
                preco: 2
            }
        ];

        function atualizarTabelaEstoque() {
            const tbody = document.getElementById('estoqueTableBody');
            tbody.innerHTML = '';

            for (let item of estoqueSimulado) {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${item.nome}</td>
                <td>${item.quantidade}</td>
                <td>${item.preco}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editarItem('${item.nome}')">Editar</button>
                </td>
            `;
                tbody.appendChild(tr);
            }
        }

        function editarItem(nome) {
            const item = estoqueSimulado.find(i => i.nome === nome);
            if (item) {
                document.getElementById('itemName').value = item.nome;
                document.getElementById('itemQuantity').value = item.quantidade;
                document.getElementById('itemPrice').value = item.preco;
            }
        }

        document.getElementById('estoqueForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const nome = document.getElementById('itemName').value;
            const quantidade = document.getElementById('itemQuantity').value;
            const preco = document.getElementById('itemPrice').value;

            const itemExistente = estoqueSimulado.find(i => i.nome === nome);
            if (itemExistente) {
                itemExistente.quantidade = parseInt(quantidade);
                itemExistente.preco = parseFloat(preco);
            } else {
                estoqueSimulado.push({
                    nome,
                    quantidade: parseInt(quantidade),
                    preco: parseFloat(preco)
                });
            }

            atualizarTabelaEstoque();
            $('#estoqueModal').modal('hide');
        });

        $('#estoqueModal').on('shown.bs.modal', function() {
            atualizarTabelaEstoque();
        });
    </script>

    <script src="scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>