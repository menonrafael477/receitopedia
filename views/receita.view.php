<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $receita->getTituloReceita(); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .imagem-receita {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .descricao-receita {
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .comentarios-likes {
            display: flex;
            gap: 15px;
            align-items: center;
            color: #777;
        }
        .comentarios, .likes, .dislikes {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $receita->getTituloReceita(); ?></h1>
        <img src="<?php echo $receita->getFotoReceita(); ?>" alt="<?php echo $receita->getTituloReceita(); ?>" class="imagem-receita">
        <div class="descricao-receita">
            <?php echo nl2br($receita->getTextoReceita()); ?>
        </div>
        <div class="comentarios-likes">
            <div class="likes">
                👍 <?php echo $receita->getLikes(); ?>
            </div>
            <div class="dislikes">
                👎 <?php echo $receita->getDislikes(); ?>
            </div>
        </div>
    </div>
</body>
</html>