<?php

$loginController = new LoginController();
$user = $loginController->getUserBySession(); 

$commentController = new CommentController(); 
$comentarios = $commentController->buscarComentariosPorReceita($receita->getId());

?>

   <div class="container-receita-completa">
        <div class="receita-detalhe">
            <header class="receita-cabecalho">
                <h1 class="receita-titulo-principal"><?php echo $receita->getTituloReceita(); ?></h1>
            </header>

            <div class="receita-imagem-principal-container">
                <img src="data:image/webp;base64, <?php echo $receita->getFotoReceita(); ?>" alt="Foto detalhada da Receita">
            </div>

            <section class="receita-descricao-texto">
                <h2>📜 Descrição / Modo de Preparo</h2>
                <p><?php echo $receita->getTextoReceita()?></p>
            </section>

            <section class="receita-meta-interacoes"> 
                <div class="interacao-botoes">
                    <form action="/recipe/<?php echo $receita->getId(); ?>/like" method="POST">
                         <input type="hidden" id="id-like "name="<?php echo $receita->getId(); ?>">
                        <button type="submit" class="botao-like">👍 <span class="contador-like"><?php echo $receita->getLikes(); ?></span></button>
                    </form>
                    <form action="/recipe/<?php echo $receita->getId(); ?>/dislike" method="POST">  
                        <input type="hidden" id="id-dislike" name="<?php echo $receita->getId(); ?>">
                        <button type="submit" class="botao-dislike">👎 <span class="contador-dislike"><?php echo $receita->getDislikes(); ?></span></button>
                    </form>
                </div>
            </section>

           <section class="secao-comentarios">
                <h2>💬 Comentários</h2>

            <div class="area-novo-comentario-form">
                <?php if ($user != null) { ?>
                    <h4>Deixe seu comentário:</h4>
                    <form id="form-comentario" action="/recipe/<?php echo htmlspecialchars($receita->getId()); ?>/comment" method="POST">
                        <div class="campo-form">
                            <input type="hidden" id="id-receita" name="id_receita" value="<?php echo htmlspecialchars($receita->getId()); ?>">
                            <input type="hidden" id="id-usuario" name="id_usuario" value="<?php echo htmlspecialchars($user->get_id()); ?>">
                            <textarea id="comentario" name="texto_comentario" rows="5" required></textarea>
                        </div>
                        <button type="submit">Enviar Comentário</button>
                    </form>
                <?php } else { ?>
                    <p>Realize <a style="color: blue" href="/login">login</a> em sua conta para comentar ou <a style="color: blue" href="/register">registre-se</a></p>
                <?php } ?>
            </div>


            <div class="area-dos-comentarios"> <?php
                if (isset($comentarios) && !empty($comentarios)) {
                    foreach ($comentarios as $comentario) {
                        ?>
                        <div class="comentario-item">
                            <p>
                                <strong><?php echo htmlspecialchars($comentario['nome_usuario']); ?></strong>
                                <span class="data-comentario">- <?php echo /* Você vai querer buscar a data real do comentário aqui */ '27/05/2025'; ?></span>
                            </p>
                            <p><?php echo htmlspecialchars($comentario['texto_comentario']); ?></p>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Nenhum comentário.</p>"; // Esta mensagem também fica dentro da área principal
                }
                ?>
            </div> 
        </section>
             
        
    <style>
        .container-receita-completa {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px 30px 40px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }

        .receita-cabecalho {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .receita-titulo-principal {
            font-size: 2.5em;
            color: #2c3e50;
            margin: 0;
        }

        .receita-imagem-principal-container img {
            width: 100%;
            max-height: 450px;
            object-fit: contain;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .receita-descricao-texto h2 {
            font-size: 1.6em;
            color: #34495e;
            margin-top: 0;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .receita-descricao-texto p {
            margin-bottom: 15px;
            font-size: 1.05em;
            color: #555;
        }

        .receita-meta-interacoes {
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 20px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: center;
        }

        .interacao-botoes {
            display: flex;
            flex-direction: row;
        }

        .interacao-botoes button {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            color: #333;
            padding: 10px 18px;
            margin: 0 10px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.2s, color 0.2s;
        }

        .interacao-botoes button:hover {
            background-color: #e0e0e0;
        }

        .botao-like:hover {
            background-color: #2ecc71;
            color: white;
            border-color: #27ae60;
        }

        .botao-dislike:hover {
            background-color: #e74c3c;
            color: white;
            border-color: #c0392b;
        }

        .interacao-botoes .contador-like,
        .interacao-botoes .contador-dislike {
            margin-left: 6px;
            font-weight: bold;
        }

        .secao-comentarios {
            margin-top: 30px;
        }

        .secao-comentarios h2 {
            font-size: 1.8em;
            color: #34495e;
            margin-bottom: 20px;
            text-align: center;
        }

        .area-para-php-comentarios {
            margin-bottom: 30px;
        }

        .placeholder-comentarios {
            color: #888;
            font-style: italic;
            text-align: center;
            padding: 20px;
            background-color: #fdfdfd;
            border: 1px dashed #ddd;
            border-radius: 4px;
        }

        .comentario-item {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .comentario-autor {
            font-size: 0.9em;
            color: #777;
            margin-bottom: 5px;
        }

        .comentario-autor strong {
            color: #333;
        }

        .comentario-data {
            font-style: italic;
        }

        .comentario-texto {
            font-size: 1em;
            color: #444;
            margin: 0;
        }

        .area-novo-comentario-form {
            background-color: #f9f9f9; 
            padding: 20px;
            border-radius: 8px; 
            margin-bottom: 50px; 
            border: 1px solid #ddd; 
        }

        .area-novo-comentario-form h4 {
            margin-top: 0;
            margin-bottom: 15px; 
            font-size: 1.2em; 
            color: #333; 
        }

        #form-comentario .campo-form {
            margin-bottom: 15px; 
        }

        #form-comentario textarea#comentario {
            width: 100%; 
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
            font-family: inherit; 
            font-size: 1em;
            resize: vertical; 
        }

        #form-comentario button[type="submit"] {
            background-color: #5cb85c; 
            color: white; 
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer; 
            font-size: 1em;
            transition: background-color 0.3s ease; 
        }

        #form-comentario button[type="submit"]:hover {
            background-color: #4cae4c
        }
    </style>