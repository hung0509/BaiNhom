<?
    class Genre{
        public $id_genre;
        public $namegenre;

        public function __toString()
        {
            return $this->namegenre;
        }

        public function __construct($id_genre ='', $namegenre ='') {
            if($id_genre != "" && $namegenre != ""){
                $this->id_genre = $id_genre;
                $this->namegenre = $namegenre;
            }
        }

        public static function count($conn){
            try{
                $sql = "select count(id_genre) from genres;";
                return $conn->query($sql)->fetchColumn();
            }catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }

        public static function getAll($conn){
            try{
                $sql = "select * from genres";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Genre');
                if($stmt->execute()){
                    $g = $stmt->fetchAll();
                    return $g;
                }
            }catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }
        public static function getNamebyID($conn, $id){
            try{
                $sql = "select namegenre from genres  where id_genre=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
                $stmt->execute();
                $g = $stmt->fetch();
                return $g;
            }catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }

    }

?>