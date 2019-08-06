<?php
include_once ROOT."/components/Request.php";
include_once ROOT."/components/Route.php";
class Router
{
   private static $routes = array();
   private static $helper_func = array();
   private static $route_helpfunc = array();
   
   public static function any($route,$classes,$help_func=null){
      // self::$routes[$route] = $classes;
      // if($help_func!=null){
      //    self::$route_helpfunc[$help_func][]=$route;
      // }
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
      foreach (self::$routes[$meth] as $key => $value) {
         preg_match('#{([a-z,_,A-Z]+)}#', $key,$vars);
         $key = preg_replace('#{([a-z,_,A-Z]+)}#', '([A-Z,a-z,0-9]+)', $key);
         if(preg_match("#^$key$#", $url,$matches)){
            $classes = explode("@", $value->getAction());
            $kye_route = $key;
            if(count($matches)>1){
               for ($i=1; $i <= count($matches)-1; $i++) {
                  $parametrs[] = $matches[$i];
               }
            }
         }
      }

      if(isset($classes)){
         //self::dumb($parametrs);
      //    $return = self::is_helpfunc($url);

         // if($return){
         include_once ROOT."/controlers/".$classes[0].".php";
         $class = new $classes[0]();
         $action = $classes[1];
         call_user_func_array(array($class,$action), $parametrs);   
         //    if(count($matches)>1){
         //       $class->{$classes[1]}($matches[1]);
         //    }
         //    else $class->{$classes[1]}();
         // } else {
         //    header("Location: /login");
         // }
         
      } else {
          echo "page 404";   
      }
   }

   private static function is_helpfunc($key_route){
      $return = array();
      foreach (self::$route_helpfunc as $key => $value) {
         foreach ($value as $key2 => $value2) {
            if($value2==$key_route){
               $return=self::$helper_func[$key]();
               return $return;
            }
         }
      }
      return true;
   }

   private static function dumb($val){
      echo "<per>";
      var_dump($val);
      echo "</per>";
   }
}

require_once ROOT.'/components/routes.php';

