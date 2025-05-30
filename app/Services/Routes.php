<?php 

use Pecee\SimpleRouter\SimpleRouter as SimpleRouter;

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

class Routes {
    
    private static function get(string $url, $callback) {
        SimpleRouter::get($url, $callback);
    }

    private static function post(string $url, $callback) {
        SimpleRouter::post($url, $callback);
    }

    private static function put(string $url, $callback) {
        SimpleRouter::put($url, $callback);
    }

    private static function delete(string $url, $callback) {
        SimpleRouter::delete($url, $callback);
    }

    private static function start() {
        SimpleRouter::start();
    }

    private static function error($callback) {
        SimpleRouter::error($callback);
    }

    public static function defineRoutes() {
        
        // páginas
        self::get('/', 'HomeController@loadPageDefault'); 
        self::get('/search/{name}', 'HomeController@loadPageByName'); 
        self::get('/category/{category}', 'HomeController@loadPageByCategory'); 
        self::post('/search-form', 'HomeController@loadSearchButton');

        self::get('/assets/background.png', null);

        // User controller - GET
        self::get('/register', 'RegisterController@loadPageContent');
        self::get('/login', 'LoginController@loadPageContent');
        
        // User controller - POST
        self::post('/register','RegisterController@register');
        self::post('/login','LoginController@login');
        self::get('/logout', 'LoginController@logout');
        self::get('/recipe/{id}', 'ReceitaController@loadPageContentRecipe');
        self::get('/admin-panel', 'ReceitaController@loadPageContentRegisterRecipe');
        
        // requisições
        self::post('/admin-panel/create-recipe', 'ReceitaController@createRecipe');
        self::post('/admin-panel/update-recipe/{id}', 'ReceitaController@loadPageAdminUpdate');
        self::post('/admin-panel/send-update', 'ReceitaController@updateRecipe');
        self::delete('/admin-panel/delete-recipe/{id}', 'ReceitaController@deleteRecipe');

        // like e comentários
        self::post('/recipe/{id}/comment', 'CommentController@criarComentario');
        self::post('/recipe/{id}/like', 'LikeController@addLike');
        self::post('/recipe/{id}/dislike', 'LikeController@addDislike');

        self::error(function(Request $request, \Exception $exception) {
            switch(true) {
                case $exception instanceof NotFoundHttpException:
                    $errorController = new ErrorController();
                    $errorController->loadPageNotFound();
                    break;
                    
                default:
                    $errorController = new ErrorController();
                    $errorController->loadGenericError();
                    break;
            }
        });

        // start!
        self::start(); 
    }    
}

?>
    
