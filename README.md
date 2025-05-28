# Receitopédia

Criadores:<br>
https://github.com/Yan-Jardim-Leal<br>
https://github.com/menonrafael477 <br>
https://github.com/gbcapri<br><br>
Notion: https://www.notion.so/Sistema-de-Culin-ria-Receitop-dia-1e1a7e6b6a8780eaa953d0828aee098a

# Instalação:

Requisitos:
- XAMPP / Apache e MySQL
- Composer
- Pecee Simple-Router

## Etapa 1
 
Download XAMPP (Windows, Linux, macOS): https://www.apachefriends.org/pt_br/download.html \
Download Composer (Windows, Linux, macOS): https://getcomposer.org/download/ \
Colocar receitopedia-main dentro de /xampp/htdocs 

## Etapa 2

Criar o banco de dados no PHPMyAdmin (*link Notion*) / CREATE DATABASE receitopedia; \
Alterar no httpd.conf: 
 - AllowOverride None para AllowOverride All (CTRL + F)
 - DocumentRoot "/xampp/htdocs" para DocumentRoot "/xampp/htdocs/receitopedia-main/public"

## Etapa 3

No terminal, acessar o diretório do receitopedia-main \
Comandos: <br><br>

composer init 
- Package name: [ENTER] 
- Description: [ENTER] 
- Author: n ou [ENTER} 
- Minimum Stability: [ENTER] 
- Package Type: [ENTER] 
- License: [ENTER] 
- Dependencies (require) interactively [ENTER] 
- Search for a package: [ENTER] 
- Dev dependencies (require interactively: [ENTER] 
- Search for a package: [ENTER] 
- Add PSR-4: Autoload mapping: n 
  
composer install \
composer require pecee/simple-router 

No arquivo composer.json, colar depois do require:

    ,
    "autoload": {
        "classmap": ["./"]
    }

composer dump-autoload

# Acesso

Digite localhost no navegador \
Para adicionar receitas, cadastre um usuário, vá à tabela usuarios no PHPMyAdmin e mude a propriedade isAdmin para 1 no usuário desejado. Depois, acesse: localhost/admin-panel



    
