<?
    class Auth{
        //Kiểm tra đăng nhập 
        public static function isLoggedIn(){
            return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
        }

        // Bắt buộc phải đăng nhập 
        public static function requireLogin(){
            if(!Auth::isLoggedIn()){
                return "Please login to continue !";
            }
        }

        //Xử lý đăng nhập
        public static function login(){
            // Hàm này tạo một Session ID mới,
            session_regenerate_id(true);
            //Đặt thời gian sống cho session là 1800s = 30 phút;
            session_set_cookie_params(1800);
            $_SESSION['logged_in'] = true;
        }

        //Xử lý đăng xuất
        public static function logout(){
            // Xóa Session ID trên máy tính người dùng
            if(ini_get("session.use_cookies")){
                $params = session_get_cookie_params();
                setcookie(session_name(), 
                            '',
                            time() - 42000,
                            $params["path"],
                            $params["domain"],
                            $params["secure"],
                            $params["httponly"]);
            }
            // Hủy (xóa) tất cả Session
            session_destroy();
        }
    }

?>