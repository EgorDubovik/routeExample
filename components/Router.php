<?php
include_once ROOT."/components/Request.php";
include_once ROOT."/components/Route.php";
include_once ROOT.'/components/Response.php';
class Router
{
   private static $routes = array();
   private static $helper_func = array();
   private static $route_helpfunc = array();
   
   public static function any($route,$classes){
      $methods = array("GET","POST","DELETE","PUT","OPTION");
      self::add($methods,$route,$classes);
   }

   public static function get($route,$classes){
      $methods = array("GET");
      self::add($methods,$route,$classes);  
   }

   public static function post($route,$classes){
      $methods = array("POST");
      self::add($methods,$route,$classes);  
   }

   public static function add($methods,$route,$classes){
      $routeObj = new Route($methods,$route,$classes);
      foreach ($methods as $key => $method) {
         self::$routes[$method][$route] = $routeObj;
      }
   } 

   public static function setHelpFunc($arrg,$func){
      self::$helper_func[$arrg]=$func;
   }

   public static function getHelpFunc(){
      echo "<per>";
      var_dump(self::$helper_func);
      echo "</per>";
   }
   public static function run(){
      $request = new Request();
      //([A-Z,a-z,0-9]+)
      $url = $request->url;
      $meth = $request->method;
      $parametrs = array();
      $route = null;
      foreach (self::$routes[$meth] as $key => $value) {
         preg_match('#{([a-z,_,A-Z]+)}#', $key,$vars);
         $key = preg_replace('#{([a-z,_,A-Z]+)}#', '([A-Z,a-z,0-9]+)', $key);
         if(preg_match("#^$key$#", $url,$matches)){
            $route = $value;
            $kye_route = $key;
            if(count($matches)>1){
               for ($i=1; $i <= count($matches)-1; $i++) {
                  $parametrs[] = $matches[$i];
               }
            }
         }
      }

      if(!is_null($route)){
         if(gettype($route->getAction())=="string"){
            $classes = explode("@", $route->getAction());
            include_once ROOT."/controlers/".$classes[0].".php";
            $class = new $classes[0]();
            $action = $classes[1];
            call_user_func_array(array($class,$action), $parametrs);   
         } else { // if object
            $response = call_user_func($route->getAction());
         }
      } else {
         Response::e404();  
      }
   }

   private static function dumb($val){
      echo "<per>";
      var_dump($val);
      echo "</per>";
   }
}

require_once ROOT.'/components/routes.php';

