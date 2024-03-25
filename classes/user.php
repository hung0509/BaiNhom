<?
class User
{
    public $id_user;
    public $username;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    public $id_role;


    public function getName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function __construct($username = '', $password = '', $email = '', $firstname = '', $lastname = '', $id_role = '')
    {
        if ($username != '' && $password != '' && $email != '' && $firstname != '' && $lastname != '' && $id_role != '') {
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->id_role = $id_role;
        }
    }

    protected function validate()
    {
        return $this->username && $this->password;
    }

    private function checkUsername($conn)
    {
        try {
            $sql = "select * from users where username=:username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $stmt->execute();
            $user = $stmt->fetch();

            if(empty($user)){
                return true;
            }
            return false;

        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function addUser($conn)
    {
        try {
            //Kiểm tra username và password có trống không, kiểm tra có tồn tại username nào ko
            if ($this->checkUsername($conn) && $this->validate()) {
                // Write sql querry
                //Tạo tài khoản người dùng
                $sql = "insert into users(username, password, firstname, lastname, email, id_role)
                        values (:username, :password, :firstname, :lastname, :email, :id_role);";

                // Prepare connection
                $stmt = $conn->prepare($sql);
                $hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
                $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
                $stmt->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
                $stmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
                $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindValue(':id_role', $this->id_role, PDO::PARAM_INT);
                return $stmt->execute();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
    

    public function editUser($conn, $password){
        try{
            $sql = "update users SET password=:password,firstname=:firstname,lastname=:lastname where id_user=:id_user";
            $stmt = $conn->prepare($sql);
            
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
            $stmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
            $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
            return $stmt->execute();
        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }
    }

    public static function authenticate($conn, $username, $password)
    {
        $sql = "select * from users where username=:username";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $hash = $user->password;
            if (password_verify($password, $hash)) {
                //Trả về người dùng
                return $user;
            }
        }
    }
}
