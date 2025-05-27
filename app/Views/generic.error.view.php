<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Erro</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5; /* Um cinza claro para o fundo */
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Garante que o conteúdo fique centralizado verticalmente na tela inteira */
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .error-container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .error-code {
            font-size: 5rem; /* Tamanho grande para o código do erro */
            font-weight: bold;
            color: #ff6347; /* Um laranja/vermelho para destaque, similar ao que usamos antes */
            margin-bottom: 10px;
            line-height: 1;
        }

        .error-heading {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
        }

        .error-message p {
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .error-message p:last-child {
            margin-bottom: 25px;
        }

        .btn-action {
            display: inline-block;
            padding: 12px 25px;
            background-color: #ff6347;
            color: white;
            text-decoration: none;
            border-radius: 20px; /* Borda arredondada como nos exemplos anteriores */
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-action:hover {
            background-color: #e0523a; /* Cor mais escura no hover */
        }

        /* Para telas menores, reduzir um pouco o tamanho da fonte do código de erro */
        @media (max-width: 600px) {
            .error-code {
                font-size: 4rem;
            }
            .error-heading {
                font-size: 1.5rem;
            }
            .error-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="error-heading">Oops! Um problema ocorreu...</div>
        <div class="error-message">
            <p>Parece que algo não correu corretamente.</p>
        </div>
        <a href="/" class="btn-action">Voltar para a Página Inicial</a>
        </div>

</body>
</html>