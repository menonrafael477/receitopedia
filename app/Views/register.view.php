<div class="form-container">
    <h1>Criar Conta</h1>
    <form>
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn-primary">Registrar</button>
    </form>
    <div class="bottom-link">
        <p>Já tem uma conta? <a href="#">Faça login</a></p>
    </div>
</div>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px 0;
    }

    .form-container {
        background-color: #fff;
        padding: 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
    }

    .form-container h1 {
        color: #333;
        text-align: center;
        margin-top: 0;
        margin-bottom: 30px;
        font-size: 2em;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #555;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 1em;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus {
        border-color: #ff6347;
    }

    .btn-primary {
        width: 100%;
        padding: 12px 15px;
        background-color: #ff6347;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 1.1em;
        font-weight: 500;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background-color: #e0523a;
    }

    .bottom-link {
        text-align: center;
        margin-top: 25px;
    }

    .bottom-link a {
        color: #ff6347;
        text-decoration: none;
        font-weight: 500;
    }

    .bottom-link a:hover {
        text-decoration: underline;
    }
</style>