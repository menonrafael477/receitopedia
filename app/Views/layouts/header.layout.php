<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitopédia</title>
    <link rel="stylesheet" href="/css/header.layout.css">
</head>
<body>
    <header class="site-header">
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="/" class="logo">Receitopédia</a>
            </div>
            <div class="search-container">
                <form action="/search-form" method="POST">
                    <input type="search" id="searchInput" placeholder="Buscar receitas..." aria-label="Buscar receitas" name="search_text">
                    <button type="submit" id="searchButton">Buscar</button>
                </form>
            </div>
            <ul class="nav-links">
                <li><a href="/">Início</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle">Receitas <span class="arrow-down">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/category/doces">Doces</a></li>
                        <li><a href="/category/salgados">Salgadas</a></li>
                        <li><a href="/category/bebidas">Bebidas</a></li>
                        <li><a href="/category/vegetarianas">Vegetarianas</a></li>
                    </ul>
                </li>
                <li><a href="/contato">Contato</a></li>
            </ul>
            <div class="user-actions">
                <a href="/login" class="login-link">Login</a>
                <a href="/cadastro" class="btn-cadastro">Cadastre-se</a>
            </div>
            <button class="menu-toggle" aria-label="Abrir menu" aria-expanded="false"> &#9776; </button>
        </nav>
    </header>