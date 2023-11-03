<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio do Restaurante</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="icon" href="seu-icone.png" type="images/ico.png">

    <style>
        body {
            background-color: #e0f2e9;
        }

        .header {
            background-color: #064F24;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .header a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }

        .container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
        }

        .category-btn {
            background-color: #064F24;
            border-color: #064F24;
            border-radius: 10px;
            font-size: 20px;
            padding: 10px 20px;
            color: #fff;
        }

        .category-btn:hover {
            background-color: #053c1d;
            border-color: #053c1d;
        }

        #menu {
            list-style: none;
            padding: 0;
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .menu-item-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .item-image img {
            max-width: 100px;
            margin-right: 10px;
            margin-top: 10px;
        }

        .item-details-text {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .item-details-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .menu-item:hover {
            background-color: #e0e0e0;
        }

        .menu-item-title {
            font-weight: bold;
        }

        .quantity-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
        }

        .add-to-cart {
            background-color: #064F24;
            border-color: #064F24;
            border-radius: 10px;
            font-size: 16px;
            padding: 5px 10px;
            color: #fff;
            align-self: flex-end;
        }

        .add-to-cart:hover {
            background-color: #053c1d;
            border-color: #053c1d;
        }

        #cart {
            margin-top: 30px;
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
        }

        .btn-success {
            background-color: #064F24;
            border-color: #064F24;
            border-radius: 10px;
            font-size: 20px;
            padding: 10px 20px;
        }

        .btn-success:hover {
            background-color: #053c1d;
            border-color: #053c1d;
        }

        .remove-from-cart {
            background-color: #FF0000;
            border-color: #FF0000;
            border-radius: 10px;
            font-size: 16px;
            padding: 5px 10px;
            color: #fff;
        }

        .remove-from-cart:hover {
            background-color: #CC0000;
            border-color: #CC0000;
        }

        .add-button-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 10px;
        }

        .add-button {
            margin-top: 10px;
        }

        .item-image img {
            max-width: 100px;
            margin-top: 10px;
        }

        .menu-item-description {
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="#">Chamar Ajuda</a>
        <a href="#" id="meus-pedidos-link">Meus Pedidos</a>
        <a href="#">Finalizar Comanda</a>
    </div>
    <div class="container">
        <h1 class="text-center">Cardápio do Restaurante</h1>

        <div class="btn-group">
            <button class="btn btn-primary category-btn" data-category="entradas">Entradas</button>
            <button class="btn btn-primary category-btn" data-category="pratos-principais">Pratos Principais</button>
            <button class="btn btn-primary category-btn" data-category="lanches">Lanches</button>
            <button class="btn btn-primary category-btn" data-category="sobremesas">Sobremesas</button>
            <button class="btn btn-primary category-btn" data-category="bebidas">Bebidas</button>
        </div>

        <ul class="list-group mt-3" id="menu">
        </ul>

        <div id="cart" class="mt-4">
            <h2>Carrinho de pedidos</h2>
            <ul class="list-group" id="cart-items">
            </ul>
            <div class="d-flex justify-content-between align-items-center text-right">
                <div>
                    <button class="btn btn-success" id="confirm-order">Confirmar Pedido</button>
                    <button class="btn btn-danger" id="clear-order">Excluir Pedido</button>
                </div>
                <p>Total: <span id="cart-total">R$ 0.00</span></p>
            </div>
        </div>

    </div>
    <script>
        const menuData = {
            entradas: [{
                    name: "Bruschetta de Tomate e Manjericão",
                    price: 12.00,
                    description: "Uma combinação irresistível de tomates frescos, manjericão e pão crocante."
                },
                {
                    name: "Carpaccio de Carne",
                    price: 15.00,
                    description: "Finas fatias de carne temperadas com molho especial e acompanhadas de queijo parmesão."
                },
                {
                    name: "Salada Caesar",
                    price: 10.00,
                    description: "Uma salada clássica com alface romana, croutons, parmesão e molho Caesar."
                }
            ],
            "pratos-principais": [{
                    name: "Spaghetti à Carbonara",
                    price: 20.00,
                    description: "Massa italiana al dente com ovos, queijo pecorino, pancetta e pimenta preta."
                },
                {
                    name: "Frango Grelhado com Legumes",
                    price: 18.00,
                    description: "Peito de frango grelhado servido com uma seleção de legumes frescos."
                },
                {
                    name: "Salmão ao Molho de Maracujá",
                    price: 25.00,
                    description: "Salmão grelhado regado com molho de maracujá doce e azedo."
                }
            ],
            sobremesas: [{
                    name: "Tiramisu",
                    price: 8.00,
                    description: "Uma sobremesa italiana clássica com camadas de biscoitos de café e mascarpone cremoso."
                },
                {
                    name: "Mousse de Chocolate",
                    price: 7.00,
                    description: "Um indulgente mousse de chocolate suave e cremoso."
                },
                {
                    name: "Sorvete de Baunilha com Calda de Frutas Vermelhas",
                    price: 9.00,
                    description: "Sorvete de baunilha coberto com uma calda de frutas vermelhas frescas."
                }
            ],
            bebidas: [{
                    name: "Refrigerante (lata)",
                    price: 4.00,
                    description: "Uma lata gelada de seu refrigerante favorito."
                },
                {
                    name: "Suco Natural (laranja, morango, abacaxi)",
                    price: 5.00,
                    description: "Um refrescante suco natural feito com frutas frescas."
                },
                {
                    name: "Vinho Tinto (garrafa)",
                    price: 30.00,
                    description: "Uma garrafa de vinho tinto selecionado para acompanhar sua refeição."
                }
            ]
        };

        const cart = [];
        let total = 0;

        function showCategory(category) {
            const menuList = document.getElementById("menu");
            menuList.innerHTML = "";

            menuData[category].forEach((item, index) => {
                const listItem = document.createElement("li");
                listItem.className = "list-group-item menu-item";
                listItem.innerHTML = `
                <li class="list-group-item menu-item">
    <div class="menu-item-details">
        <div class="item-image">
            <img src="caminho_para_sua_imagem.jpg" alt="Imagem do prato">
        </div>
        <div class="item-details-text">
            <div class="menu-item-title">${item.name}</div>
            <div>R$ ${item.price.toFixed(2)}</div>
            <div class="menu-item-description">${item.description}</div> <!-- Adicione a descrição aqui -->
        </div>
        <div class="item-details-actions">
            <div class="quantity-container">
                <button class="btn btn-primary decrease-quantity">-</button>
                <input type="number" class="form-control quantity-input" value="1" min="1">
                <button class="btn btn-primary increase-quantity">+</button>
            </div>
            <button class="btn btn-success add-to-cart add-button" data-index="${index}">Adicionar</button>
        </div>
    </div>
</li>


                `;
                menuList.appendChild(listItem);

                const decreaseQuantityButton = listItem.querySelector(".decrease-quantity");
                const increaseQuantityButton = listItem.querySelector(".increase-quantity");
                const quantityInput = listItem.querySelector(".quantity-input");

                decreaseQuantityButton.addEventListener("click", () => {
                    const currentQuantity = parseInt(quantityInput.value);
                    if (currentQuantity > 1) {
                        quantityInput.value = (currentQuantity - 1).toString();
                    }
                });

                increaseQuantityButton.addEventListener("click", () => {
                    const currentQuantity = parseInt(quantityInput.value);
                    quantityInput.value = (currentQuantity + 1).toString();
                });
            });

            const addToCartButtons = document.querySelectorAll(".add-to-cart");
            addToCartButtons.forEach((button) => {
                button.addEventListener("click", (event) => {
                    const index = event.target.getAttribute("data-index");
                    const selectedItem = menuData[category][index];
                    const quantityInput = event.target.parentElement.querySelector(".quantity-input");
                    const quantity = parseInt(quantityInput.value);
                    for (let i = 0; i < quantity; i++) {
                        cart.push(selectedItem);
                        total += selectedItem.price;
                    }
                    updateCart();
                });
            });
        }

        function updateCart() {
            const cartItemsList = document.getElementById("cart-items");
            cartItemsList.innerHTML = "";

            cart.forEach((item, index) => {
                const cartItem = document.createElement("li");
                cartItem.className = "list-group-item";
                cartItem.innerHTML = `${item.name} - R$ ${item.price.toFixed(2)}
                <button class="btn btn-danger btn-sm remove-from-cart" data-index="${index}">Remover</button>`;
                cartItemsList.appendChild(cartItem);
            });

            const cartTotal = document.getElementById("cart-total");
            cartTotal.textContent = `R$ ${total.toFixed(2)}`;

            const removeFromCartButtons = document.querySelectorAll(".remove-from-cart");
            removeFromCartButtons.forEach((button) => {
                button.addEventListener("click", (event) => {
                    const index = event.target.getAttribute("data-index");
                    const removedItem = cart.splice(index, 1)[0];
                    total -= removedItem.price;
                    updateCart();
                });
            });

            const clearOrderButton = document.getElementById("clear-order");
            clearOrderButton.addEventListener("click", () => {
                cart.length = 0; // Limpa o array cart
                total = 0; // Define o total como 0
                updateCart(); // Atualiza o carrinho de compras para refletir as mudanças
            });
        }

        const categoryButtons = document.querySelectorAll(".category-btn");
        categoryButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const category = button.getAttribute("data-category");
                showCategory(category);
            });
        });

        const confirmOrderButton = document.getElementById("confirm-order");
        confirmOrderButton.addEventListener("click", () => {
            alert("Pedido enviado!");
        });

        showCategory("entradas");

        const meusPedidosLink = document.getElementById("meus-pedidos-link");
        meusPedidosLink.addEventListener("click", () => {
            window.location.href = "pedidos.html";
        });
    </script>
</body>

</html>