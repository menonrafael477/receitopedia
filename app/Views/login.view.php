<div class="login-background">    
    <img src="assets/background.png" class="form-container"></img>
    <div class="login-container">
        <h1>Login</h1>
        <form action="/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="passwd" name="passwd" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        <div class="register-link">
            <p>Não tem uma conta? <a href="/register">Crie uma aqui</a></p>
        </div>
    </div>
</div>

<style>

    .login-background {
        width: 100%;
        height: 93vh;
        /* background-image: url(assets/background.png); ;
        background-size: no-repeat;
        background-position: center; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        background-color: #fff;
        padding: 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
        margin-left: 50vw;
    }

    .login-container h1 {
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

    .btn-login {
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

    .btn-login:hover {
        background-color: #e0523a;
    }

    .register-link {
        text-align: center;
        margin-top: 25px;
    }

    .register-link a {
        color: #ff6347;
        text-decoration: none;
        font-weight: 500;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>