<?
    spl_autoload_register(
        function($classname){
            $filename = strtolower($classname) . ".php";
            $dirRoot = dirname(__DIR__);
            require $dirRoot . "/classes/{$filename}";
        }
    );
    require dirname(__DIR__) . "/config.php";
    if(session_id() === '') 
        session_start();
?>