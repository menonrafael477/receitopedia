<?php require 'controllers/receitopedia.controller.php'; ?>

<?php $controller = new ReceitopediaController(); ?>

<div class="recipe-row">
   
    <div class="recipe-actions">
        <!-- PHP: Links/botões que acionam edição/exclusão -->
        <!-- Exemplo com links: -->
        <a href="?action=edit&id=[ID_DA_RECEITA]" class="btn-edit" title="Editar Receita">Editar</a>
        <a href="?action=delete&id=[ID_DA_RECEITA]" onclick="return confirm('Tem certeza que deseja excluir esta receita?');" class="btn-delete" title="Excluir Receita">Excluir</a>

        <!-- Ou exemplo com botões (requer JS ou form submit): -->
        <!--
        <button type="button" class="btn-edit" data-id="[ID_DA_RECEITA]">Editar</button>
        <button type="button" class="btn-delete" data-id="[ID_DA_RECEITA]">Excluir</button>
        -->
    </div>
</div>

<div class="recipe-row">
    
    <?php for($x = 1; $x > 0; $x--) : ?>
        <?php for($y = 2; $y > 0; $y--) : ?>
        <span class="recipe-id"><?php echo $controller->get_todas_receitas_admin()[$x][$y] ?></span>
        <?php endfor; ?>
    <?php endfor; ?>

    <div class="recipe-actions">
        <!-- PHP: Links/botões que acionam edição/exclusão -->
        <!-- Exemplo com links: -->
        <a href="?action=edit&id=[ID_DA_RECEITA]" class="btn-edit" title="Editar Receita">Editar</a>
        <a href="?action=delete&id=[ID_DA_RECEITA]" onclick="return confirm('Tem certeza que deseja excluir esta receita?');" class="btn-delete" title="Excluir Receita">Excluir</a>

        <!-- Ou exemplo com botões (requer JS ou form submit): -->
        <!--
        <button type="button" class="btn-edit" data-id="[ID_DA_RECEITA]">Editar</button>
        <button type="button" class="btn-delete" data-id="[ID_DA_RECEITA]">Excluir</button>
        -->
    </div>
</div>
