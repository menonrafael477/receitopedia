<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitopedia</title>
    <link rel="stylesheet" href="style/receitopedia.css">
</head>
<body>
    <h1>Receitas Deliciosas</h1>
    <section class="container-imagens">
        <?php if (!empty($this->receitas)): ?>
            <?php foreach ($this->receitas as $receita): ?>
                <div class="item-imagem">
                    <a href="receita.controller.php?action=get_receita&id=<?php echo $receita->getId(); ?>">
                        <h2 class="titulo-imagem"><?php echo $receita->getTituloReceita(); ?></h2>
                        <img src="<?php echo $receita->getFotoReceita(); ?>" alt="<?php echo $receita->getTituloReceita(); ?>">
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