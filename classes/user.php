<?
    class User{
        public $id_user;
        public $username;
        public $password;
        private $email;
        private $firstname;
        private $lastname;
        private $id_role;


        public function getName(){
            return $this->firstname . " " . $this->lastname;
        }

        public function __construct($username = '', $password = '', $email='', $firstname='', $lastname='', $id_role=''){
            if($username = ''&& $password = ''&& $email=''&& $firstname=''&& $lastname=''&& $id_role=''){
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->id_role = $id_role;
            }
        }

        protected function validate(){
            return $this->username && $this->password;
        }

        public static function authenticate($conn, $username, $password){
            $sql = "select * from users where username=:username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $stmt->execute();
            $user = $stmt->fetch();

            if($user){
                $hash = $user->password;
                if(password_verify($password, $hash)){
                    return $user;
                }
            }
        }
    }

?>