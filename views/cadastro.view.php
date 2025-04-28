<h1>Cadastro de Usuário</h1>
<form action="cadastro.php?action=cadastro" method="POST">
    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </div>
    <button type="submit">Cadastrar</button>
</form>
