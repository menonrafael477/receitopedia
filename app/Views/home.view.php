
        <div class="container-pagina-receitas">
            <div class="div-lista-receitas">
                <?php
                if (isset($receitas) && !empty($receitas)) {
                    foreach ($receitas as $receita) {
                ?>      
                    <a href="/recipe/<?php echo $receita->getId(); ?>"> 
                         <div class="receita-item-card">
                            <div class="receita-imagem-container">
                                <img src="data:image/png;base64, <?php echo $receita->getFotoReceita(); ?>" alt="Foto de <?php echo $receita->getTituloReceita(); ?>">
                            </div>
                            <div class="receita-conteudo">
                                <h3 class="receita-titulo">
                                    <?php echo $receita->getTituloReceita(); ?>
                                </h3>
                                <div class="receita-interacoes">
                                    <span class="like">👍 <span class="contador"><?php echo $receita->getLikes(); ?></span></span>
                                    <span class="dislike">👎 <span class="contador"><?php echo $receita->getDislikes(); ?></span></span>
                                </div>
                            </div>
                        </div>
                    </a>      
                <?php
                    } 
                } else {
                    echo "<p>Nenhuma receita encontrada no momento.</p>";
                }
            ?>
            </div>
        </div>

<style>
    .container-pagina-receitas {
        max-width: 1200px;
        margin: 120px auto;
        padding: 20px;
    }

    .cabecalho-pagina {
        text-align: center;
        margin-bottom: 40px;
    }

    .cabecalho-pagina h1 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .cabecalho-pagina p {
        font-size: 1.1em;
        color: #7f8c8d;
    }

    .div-lista-receitas {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .receita-item-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .receita-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .receita-imagem-container img {
        width: 100%;
        height: 200px;
        object-fit: contain;
        display: block;
    }

    .receita-conteudo {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .receita-titulo {
        font-size: 1.25em;
        color: #34495e;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .receita-interacoes {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-top: 10px;
        font-size: 0.9em;
        color: #555;
    }

    .receita-interacoes .like,
    .receita-interacoes .dislike {
        display: flex;
        align-items: center;
        margin-right: 15px;
        cursor: pointer;
    }

    .receita-interacoes .contador {
        margin-left: 5px;
    }
</style>