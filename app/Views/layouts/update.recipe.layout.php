            <section id="editar-receita-exemplo" class="admin-section">
                <h2>Editar Receita: <span class="nome-receita-editando"><?php echo $receita_selecionada->getTituloReceita(); ?></span></h2>
                <form action="/admin-panel/send-update" method="POST" enctype="multipart/form-data" class="admin-form">
                    <input type="hidden" name="id_post" value=<?php echo $receita_selecionada->getId(); ?>>
                    
                    <div class="form-group">
                        <label for="titulo_receita_editar">Título da Receita:</label>
                        <input type="text" id="titulo_receita_editar" name="title" value="<?php echo $receita_selecionada->getTituloReceita(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="texto_receita_editar">Modo de Preparo (Descrição):</label>
                        <textarea id="texto_receita_editar" name="content_text" rows="8" required><?php echo $receita_selecionada->getTextoReceita(); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_receita_editar">Nova Foto da Receita (opcional):</label>
                        <input type="file" id="foto_receita_editar" name="photo" accept="image/*">
                        <p class="nota-foto">Deixe em branco para manter a foto atual.</p>
                    </div>
                    <div class="form-group">
                        <label for="categoria_editar">Categoria:</label>
                        <select id="categoria_editar" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <option value="doces" selected>Doces</option>
                            <option value="salgados">Salgados</option>
                            <option value="bebidas">Bebidas</option>
                            <option value="lanches">Vegetarianas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="/admin-panel"><button  type="button" class="btn btn-cancelar">Cancelar Edição</button></a>
                    </div>
                </form>
            </section>