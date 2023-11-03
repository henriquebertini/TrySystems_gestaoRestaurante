<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #213d26;
        }

        .card {
            margin-top: 100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: slide-up 0.5s ease;
            border: none;
            border-radius: 10px;
        }

        .container{
            width: 200%;
        }

        .card-header {
            font-size: 24px;
            background-color: #064F24;
            color: white;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px 0;
        }

        .btn-primary {
            background-color: #064F24;
            border-color: #064F24;
        }

        .btn-primary:hover {
            background-color: #064F24;
            border-color: #064F24;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Try Systems - Acessar loja</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="processamento/conexao_processamento.php">
                            <div class="form-group">
                                <label for="username">Nome de Usuário</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
