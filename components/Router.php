<?php
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath=ROOT.'/config/routes.php';
        $this->routes=include($routesPath);
    }

    //возвращает адрес
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run()
    {
        //Получить строку запроса
        $uri=$this->getURI();
        //echo $uri,'<br>';

        //Проверить наличие запроса в routes.php
        foreach($this->routes as $uriPattern => $path) {
            
            //Сравниваем $uriPattern и $uri"
            if (preg_match("~$uriPattern~",$uri)){
                //echo "$uriPattern -> $path<br>";
                //echo "+<br>";
                
                //Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~",$path,$uri);

                //Определить какой контроллер и action обрабатывает запрос
                $segments=explode('/',$internalRoute); //explode('/',$path);
                //print_r($segments); echo "<br>";

                $controllerName=array_shift($segments).'Controller';
                // if ($controllerName=='index.phpController') //Index.php
                //     $controllerName=array_shift($segments).'Controller';
                $controllerName=ucfirst($controllerName);

                $actionName='action'.ucfirst(array_shift($segments));
                //echo 'Класс : ',$controllerName, '<br>Метод : ', $actionName,'<br>';

                //Параметры
                $parameters = $segments;

                //Подключить файл класса-контроллера
                //$controllerFile=ROOT . '/' . $controllerName . '.php';
                $controllerFile=ROOT . '/controllers/' . $controllerName . '.php';
                
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                //echo $controllerFile,"<br>";
                //print_r($parameters); echo '<br>';
                
                //Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;
                
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result!=null) {
                    //exit("<meta http-equiv='refresh' content='0; url= ../../product_order.php'>");
                    break;
                }

            }
        }
    }
}
?>