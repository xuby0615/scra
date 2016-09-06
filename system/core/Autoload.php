<?php
class Autoload{     

    public static function sys_class_loader($classname){     
        $class_file = SYS_PATH.'class/'.$classname.".php";
        if (file_exists($class_file)){     
            require_once($class_file);     
        }     
    }

    public static function sys_core_loader($classname){     
        $class_file = SYS_PATH.'core/'.$classname.".php";
        if (file_exists($class_file)){     
            require_once($class_file);     
        }     
    }
    
    public static function sys_smarty_loader(){
        $class_file = SYS_PATH.'smarty/libs/Smarty.class.php';
        if (file_exists($class_file)){
            require_once($class_file);
        }
    }

    public static function app_controller_loader($classname){     
        $class_file = APP_PATH.'controller/'.$classname.".php";
        if (file_exists($class_file)){
            require_once($class_file);
        }     
    }
    
    public static function app_model_loader($classname){
        $class_file = APP_PATH.'model/'.$classname.".php";
        if (file_exists($class_file)){
            require_once($class_file);
        }
    }
          
}

foreach (get_class_methods('Autoload') as $value) {
    spl_autoload_register('Autoload::'.$value);
}

?>