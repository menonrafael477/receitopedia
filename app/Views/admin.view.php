    <div class="admin-panel-container">
        <header class="admin-header">
            <h1>Painel Administrativo de Receitas</h1>
        </header>

        <main class="admin-main-content">
            <section id="criar-receita" class="admin-section">
                <h2>Criar Nova Receita</h2>
                <form action="/admin-panel/create-recipe" method="POST" enctype="multipart/form-data" class="admin-form">
                    <div class="form-group">
                        <label for="titulo_receita_criar">Título da Receita:</label>
                        <input type="text" id="titulo_receita_criar" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="texto_receita_criar">Modo de Preparo (Descrição):</label>
                        <textarea id="texto_receita_criar" name="content_text" rows="8" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_receita_criar">Foto da Receita:</label>
                        <input type="file" id="foto_receita_criar" name="photo" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="categoria_criar">Categoria:</label>
                        <select id="categoria_criar" name="category" required>
                            <option value="">Selecione uma categoria</option>
                            <option value="doces">Doces</option>
                            <option value="salgados">Salgados</option>
                            <option value="bebidas">Bebidas</option>
                            <option value="vegetarianas">Vegetarianas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar Nova Receita</button>
                    </div>
                </form>
            </section>

            <section id="gerenciar-receitas" class="admin-section">
                <h2>Gerenciar Receitas Existentes</h2>
                <table class="receitas-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($receitas) && !empty($receitas)) {
                    
                            foreach ($receitas as $receita) {
                        ?>
                            <tr>
                                <td><?php echo ($receita->getTituloReceita()); ?></td>
                                <td><?php echo ($receita->getCategoria()); ?></td>
                                <td>
                                    
                                    <a href="/admin-panel/update-recipe" class="btn btn-secondary btn-edit">Editar</a>
                                    <form action="/admin-panel/delete-recipe/<?php echo $receita->getId(); ?>" method="POST" style="display:inline;">
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Tem certeza que deseja deletar esta receita?');">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            } 
                        } else {
                        ?>
                            <tr>
                                <td colspan="3" style="text-align: center;">Nenhuma receita cadastrada ainda.</td>
                            </tr>
                        <?php
                        } 
                        ?>
                    </tbody>
                </table>
            </section>

            <section id="editar-receita-exemplo" class="admin-section">
                <h2>Editar Receita: <span class="nome-receita-editando">Bolo de Chocolate Fofinho</span></h2>
                <form action="#link-para-seu-php-atualizar" method="POST" enctype="multipart/form-data" class="admin-form">
                    <input type="hidden" name="id_receita" value="123">
                    
                    <div class="form-group">
                        <label for="titulo_receita_editar">Título da Receita:</label>
                        <input type="text" id="titulo_receita_editar" name="titulo_receita" value="Bolo de Chocolate Fofinho" required>
                    </div>
                    <div class="form-group">
                        <label for="texto_receita_editar">Modo de Preparo (Descrição):</label>
                        <textarea id="texto_receita_editar" name="texto_receita" rows="8" required>Este é o modo de preparo do bolo de chocolate...</textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_receita_editar">Nova Foto da Receita (opcional):</label>
                        <input type="file" id="foto_receita_editar" name="foto_receita" accept="image/*">
                        <p class="nota-foto">Deixe em branco para manter a foto atual.</p>
                    </div>
                    <div class="form-group">
                        <label for="categoria_editar">Categoria:</label>
                        <select id="categoria_editar" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <option value="doces" selected>Doces e Sobremesas</option>
                            <option value="salgados">Salgados e Pratos Principais</option>
                            <option value="bebidas">Bebidas</option>
                            <option value="lanches">Lanches</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <button type="button" class="btn btn-cancelar">Cancelar Edição</button>
                    </div>
                </form>
            </section>

        </main>

        <footer class="admin-footer">
            <p>&copy; 2025 Painel Administrativo - Receitopédia</p>
        </footer>
    </div>

    <style>

    .admin-panel-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px 20px 20px;
    }

    .admin-header {
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 20px 30px;
        text-align: center;
        margin-bottom: 30px;
        border-radius: 0 0 8px 8px;
    }

    .admin-header h1 {
        margin: 0;
        font-size: 2em;
    }

    .admin-main-content {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .admin-section {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .admin-section h2 {
        margin-top: 0;
        color: #34495e;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-size: 1.6em;
    }

    .admin-form .form-group {
        margin-bottom: 20px;
    }

    .admin-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    .admin-form input[type="text"],
    .admin-form textarea,
    .admin-form select,
    .admin-form input[type="file"] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 1em;
    }

    .admin-form input[type="text"]:focus,
    .admin-form textarea:focus,
    .admin-form select:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    .admin-form textarea {
        resize: vertical;
        min-height: 120px;
    }

    .admin-form .nota-foto {
        font-size: 0.9em;
        color: #777;
        margin-top: 5px;
    }

    .btn {
        padding: 10px 18px;
        font-size: 1em;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        margin-right: 10px;
        transition: background-color 0.2s ease, opacity 0.2s ease;
    }

    .btn-primary {
        background-color: #27ae60;
        color: white;
    }

    .btn-primary:hover {
        background-color: #229954;
    }

    .btn-secondary {
        background-color: #3498db;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #2980b9;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-cancelar {
        background-color: #95a5a6;
        color: white;
    }

    .btn-cancelar:hover {
        background-color: #7f8c8d;
    }

    .receitas-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .receitas-table th,
    .receitas-table td {
        border: 1px solid #e0e0e0;
        padding: 12px;
        text-align: left;
    }

    .receitas-table thead th {
        background-color: #ecf0f1;
        color: #34495e;
        font-weight: 600;
    }

    .receitas-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .receitas-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .receitas-table .btn {
        padding: 6px 12px;
        font-size: 0.9em;
    }

    .nome-receita-editando {
        font-style: italic;
        color: #2980b9;
    }

    .admin-footer {
        text-align: center;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
        font-size: 0.9em;
        color: #777;
    }
    </style>