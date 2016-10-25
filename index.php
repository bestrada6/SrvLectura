
<?php

require_once 'view/JsonView.php';
require_once 'http/Request.php';
require_once '/data/cnx/InjectionConection.php';
require_once 'exception/ApiException.php';

spl_autoload_register('apiAutoload');
function apiAutoload($classname) {

    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        @include __DIR__ . '/controller/' . $classname . '.php';
        return true;
    } elseif (preg_match('/[a-zA-Z]+Repository$/', $classname)) {
        @include __DIR__ . '/data/' . $classname . '.php';
        return true;
    } elseif (preg_match('/[a-zA-Z]+DAO$/', $classname)) {
        @include __DIR__ . '/data/dao/' . $classname . '.php';
        return true;
    }

    return false;
}


$request= new Request();

$controller_url = ucfirst($request->url_controller[0]);
$controller_name = $controller_url . 'Controller';
$repository_name = $controller_url . 'Repository';
$data_name = $controller_url . 'DAO';


if (class_exists($controller_name) && class_exists($repository_name) && class_exists($data_name)) 
{
    $data= new $data_name(InjectionContainer::provideDatabaseInstance());
    $repository = new $repository_name($data);
    $controller = new $controller_name($repository);
    $action = strtolower($request->url_action[0]) . 'Action';
    
    $response = $controller->$action($request);
    
    $json_view = new JsonView();
    $json_view->render($response);

}else {
    throw new ApiException(400, STATUS_CODE_400_MALFORMED);
}