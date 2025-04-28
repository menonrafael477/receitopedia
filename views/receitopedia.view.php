<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitopedia</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .receita-item {
            width: calc(50% - 10px); /* Para duas colunas com um pequeno espaço entre elas */
            margin-bottom: 20px;
            text-align: center;
        }
        .receita-item img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .receita-item a {
            text-decoration: none;
            color: black;
        }
        .receita-titulo {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>Receitas Deliciosas</h1>
    <section class="container-imagens">
        <?php if (!empty($receitas)): //a não ser que tu saiba o que está fazendo não mexa nessa PORRA?>
            <?php foreach ($receitas as $receita): ?>
                <div class="item-imagem">
                    <a href="receita.controller.php?id_post=<?php echo $receita['id_post']; ?>">
                        <p class="titulo-imagem"><?php echo $receita['titulo_receita']; ?></p>
                        <img src="<?php echo $receita['foto_receita']; ?>" alt="<?php echo $receita['titulo_receita']; ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma receita encontrada.</p>
        <?php endif; ?>
    </section>
</body>
</html>

<?php
class ReceitopediaView {
    public array $receitas;

    public function renderizar(array $receitas) {
        $this->receitas = $receitas;
        require_once __FILE__;
    }
}
?>