<div class="container">
            <!-- Painel Esquerdo: Lista de Receitas -->
            <div class="panel left-panel">
                <div class="panel-header">
                    <span>ID</span>
                    <span>Nome</span>
                </div>
                <div class="panel-content">
                    <?php require('views/receita-admin.view.php'); ?>
                </div>
            </div>

            <!-- Painel Direito: Forms -->
            <div class="right-column">

                <!-- Painel Superior Direito: Form de Criar -->
                <div class="panel top-right-panel">
                    <h2>Criar</h2>
                    <div class="panel-content">
                        <!-- PHP: Aqui vai o formulário de criação -->
                        <form action="admin-panel.php?action_receita=criar" method="post">
                            <!-- Campos do formulário de criação (ex: Título, Descrição) -->
                            <label for="create-titulo">Nome:</label><br>
                            <input type="text" id="create-titulo" name="titulo_receita" required><br><br>

                            <label for="create-titulo">Categoria:</label><br>
                            <input type="text" id="create-titulo" name="categoria" required><br><br>

                            <label for="create-descricao">Descrição:</label><br>
                            <textarea id="create-descricao" name="texto_receita" rows="4" required></textarea><br><br>

                            <button type="submit">Criar Receita</button>
                            <button type="reset">Limpar</button>
                        </form>
                    </div>
                </div>

                <!-- Painel Inferior Direito: Form de Editar -->
                <div class="panel bottom-right-panel">
                    <h2>Editar</h2>
                    <div class="panel-content">
                        <p>Selecione um ID</p>
                        <!-- PHP: Aqui vai o formulário de edição, preenchido quando um ID é selecionado -->
                        <?php
                        // Exemplo: Verifica se há uma receita para editar
                        /*
                        if (isset($receita_para_editar)) {
                            echo '<form action="process.php?action=update" method="post">';
                            echo '<input type="hidden" name="id" value="' . htmlspecialchars($receita_para_editar['id']) . '">';

                            echo '<label for="edit-titulo">Titulo</label><br>';
                            echo '<input type="text" id="edit-titulo" name="titulo" value="' . htmlspecialchars($receita_para_editar['titulo']) . '" required><br><br>';

                            echo '<label for="edit-descricao">Descricao</label><br>';
                            echo '<textarea id="edit-descricao" name="descricao" rows="4" required>' . htmlspecialchars($receita_para_editar['descricao']) . '</textarea><br><br>';

                            echo '<div class="form-buttons">';
                            echo '<button type="submit" name="submit">Enviar</button>';
                            echo '<button type="button" onclick="window.location.href=\'index.php\'">cancelar</button>'; // Simples cancelamento
                            echo '</div>';

                            echo '</form>';
                        } else {
                            echo '<p>Selecione uma receita na lista para editar.</p>';
                            // Mostrar os placeholders como na imagem se nada selecionado
                            echo '<p>Titulo</p>';
                            echo '<p>Descricao</p>';
                            echo '<div class="form-buttons">';
                            echo '<button type="submit" disabled>Enviar</button> ';
                            echo '<button type="button" disabled>cancelar</button>';
                            echo '</div>';
                        }
                        */
                        // Placeholder estático como na imagem:
                        echo '<form style="margin-top: 15px;">'; // Form só para agrupar visualmente
                        echo '<label>Nome</label><br>';
                        echo '<input type="text" disabled placeholder="Título da receita selecionada"><br><br>';
                        echo '<label>Descrição</label><br>';
                        echo '<textarea rows="3" disabled placeholder="Descrição da receita selecionada"></textarea><br><br>';
                        echo '<div class="form-buttons">';
                        echo '<button type="submit" disabled>Enviar</button> ';
                        echo '<button type="button" disabled>cancelar</button>';
                        echo '</div>';
                        echo '</form>';
                        ?>
                    </div>
                </div>
            </div>
        </div>