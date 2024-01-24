<?
    class Genre{
        public $id_genre;
        public $namegenre;

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
                $stmt->execute();
                $g = $stmt->fetchAll();
                return $g;
            }catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }

    }

?>