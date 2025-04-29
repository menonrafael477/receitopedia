<form action="login.php?action_login=login" method="POST">
    <h2>ACESSE A SUA CONTA</h2>
    <div class="div-label">
        <label class="label" for="email">E-mail</label> </div>
    <div>
        <input class="input" type="email" name="email" id="email" required> </div>
    <div class="div-label">
        <label class="label" for="senha">Senha</label> </div>
    <div>
        <input class="input" type="password" name="senha" id="senha" required> </div>
    <button type="submit">FAZER LOGIN</button>
    <a href="cadastro.php">Ainda não possui conta?</a>
</form>