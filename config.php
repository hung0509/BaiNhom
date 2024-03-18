<?
    if (!defined('DB_HOST')) {
        define('DB_HOST', 'localhost');
      }
      
    if (!defined('DB_NAME')) {
      define('DB_NAME', 'db_movie');
    }
    
    if (!defined('DB_USER')) {
      define('DB_USER', 'admin');
    }
    
    if (!defined('DB_PASS')) {
      define('DB_PASS', 'admin');
    }

    if (!defined('FILE_MAX_SIZE')) {
      define('FILE_MAX_SIZE', 2 * 1024 * 1024);
    }
    
    if (!defined('FILE_TYPE')) {
      define('FILE_TYPE', ['image/gif', 'image/png', 'image/jpeg']);
    }
?>