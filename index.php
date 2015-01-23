<?php

define('BR', '<br/>');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('CONFIG_PATH', ROOT . 'config' . DS);
define('CORES_PATH',  ROOT . 'cores'  . DS);
define('MODELS_PATH', ROOT . 'models' . DS);
define('VIEWS_PATH',  ROOT . 'views'  . DS);



try {
    require_once CONFIG_PATH . 'config.php';
    require_once CONFIG_PATH . 'cores.php';
    require_once CONFIG_PATH . 'routes.php';
    require_once CONFIG_PATH . 'models.php';
    // require_once APP_PATH . 'languaje.php';
    // require_once APP_PATH . 'controller.php';
    
    // require_once APP_PATH . 'views.php';
    // require_once APP_PATH . 'registro.php';
    // require_once APP_PATH . 'database.php';
    // require_once CONFIG_PATH . 'session.php';
    // require_once APP_PATH . 'hash.php';
    // require_once APP_PATH . 'helpper.php';
    // require_once APP_PATH . 'OMLib.php';
    Session::init();
    Bootstrap::run(new Request());

} catch (Exception $e) {
    echo '<h2 style="color: red;">Error Interno 8080</h2>';
    echo '<b>Mensage:</b>';
    echo $e->getMessage();
    die();
}