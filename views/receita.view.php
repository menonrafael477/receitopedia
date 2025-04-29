<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $receita->getTituloReceita(); ?></title>
    <link rel="stylesheet" href="style/receita.css">
</head>
<body>
    <div class="container">
        <div class="nav-receita">
            <a href="eventlistener.controller.php?action=listar_receitas" class="btn-voltar">
                ← Todas as receitas
            </a>

        </div>
        <h1><?php echo $receita->getTituloReceita(); ?></h1>

        <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] === $receita->getAutorId()): ?>
        <div class="acoes-receita">
            <a href="receita.controller.php?action=editar&id=<?= $receita->getIdReceita() ?>" class="btn-editar">
            ✏️ Editar
            </a>
            <form action="receita.controller.php?action=excluir" method="POST" onsubmit="return confirm('Deseja mesmo excluir esta receita?');" style="display:inline">
            <input type="hidden" name="id_receita" value="<?= $receita->getIdReceita() ?>">
            <button type="submit" class="btn-excluir">🗑️ Excluir</button>
            </form>
        </div>
        <?php endif; ?>

        <img src="<?php echo $receita->getFotoReceita(); ?>" alt="<?php echo $receita->getTituloReceita(); ?>" class="imagem-receita">
        <div class="descricao-receita">
            <?php echo nl2br($receita->getTextoReceita()); ?>
        </div>
        <div class="comentarios-likes">
            <button id="btn-like" class="likes" aria-label="Curtir receita">
                👍 <span id="likes-count"><?= $receita->getLikes() ?></span>
            </button>
            <button id="btn-dislike" class="dislikes" aria-label="Descurtir receita">
                👎 <span id="dislikes-count"><?= $receita->getDislikes() ?></span>
            </button>
        </div>

        <div class="secao-comentarios">
            <h2>Comentários</h2>
            <?php if (!empty($comentarios)): ?>
                <?php foreach ($comentarios as $comentario): ?>
                    <div class="comentario">
                        <div class="comentario-autor"><?php echo $comentario['nome_usuario']; ?> disse:</div>
                        <p><?php echo nl2br($comentario['texto_comentario']); ?></p>
                        </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Ainda não há comentários. Seja o primeiro a comentar!</p>
            <?php endif; ?>

            <?php if (isset($_SESSION['id_usuario'])): ?>
                <div class="form-comentario">
                    <h3>Deixe seu comentário:</h3>
                    <form action="comentario.controller.php?action=criar_comentario" method="post">
                        <input type="hidden" name="id_receita" value="<?php echo $receita->getIdReceita(); ?>">
                        <label for="texto_comentario">Comentário:</label>
                        <textarea id="texto_comentario" name="texto_comentario" rows="4" required></textarea>
                        <button type="submit">Enviar Comentário</button>
                    </form>
                </div>
            <?php else: ?>
                <p><a href="login.php">Faça login</a> para deixar um comentário.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likesButton = document.querySelector('.likes');
            const dislikesButton = document.querySelector('.dislikes');
            const likesCountSpan = document.getElementById('likes-count');
            const dislikesCountSpan = document.getElementById('dislikes-count');
            const receitaId = <?php echo $receita->getIdReceita(); ?>;
            const usuarioId = <?php echo isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'null'; ?>;

            function atualizarContadores(likes, dislikes) {
                likesCountSpan.textContent = likes;
                dislikesCountSpan.textContent = dislikes;
            }

            likesButton.addEventListener('click', function() {
                if (usuarioId) {
                    fetch(`eventlistener.controller.php?action=dar_like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id_receita=${receitaId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Recarregar a página ou atualizar os contadores via outra chamada fetch
                            fetch(`eventlistener.controller.php?action=obter_contagens&id_receita=${receitaId}`)
                                .then(response => response.json())
                                .then(counts => atualizarContadores(counts.likes, counts.dislikes));
                        } else {
                            alert(data.message);
                        }
                    });
                } else {
                    alert('Você precisa estar logado para dar like.');
                }
            });

            dislikesButton.addEventListener('click', function() {
                if (usuarioId) {
                    fetch(`eventlistener.controller.php?action=dar_dislike`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id_receita=${receitaId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Recarregar a página ou atualizar os contadores via outra chamada fetch
                            fetch(`eventlistener.controller.php?action=obter_contagens&id_receita=${receitaId}`)
                                .then(response => response.json())
                                .then(counts => atualizarContadores(counts.likes, counts.dislikes));
                        } else {
                            alert(data.message);
                        }
                    });
                } else {
                    alert('Você precisa estar logado para dar dislike.');
                }
            });

            // Função para obter a contagem inicial de likes e dislikes
            function obterContagensIniciais() {
                fetch(`eventlistener.controller.php?action=obter_contagens&id_receita=${receitaId}`)
                    .then(response => response.json())
                    .then(counts => atualizarContadores(counts.likes, counts.dislikes));
            }

            obterContagensIniciais();
        });
    </script>
</body>
</html>