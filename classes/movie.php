<?
    class Movie{
        public $id_movie;
        public $moviename;
        public $nation;
        public $description;
        public $actors;
        public $director;
        public $imagefile;
        public $movielength;

        public function __construct($id_movie ='',$moviename='', $nation = '', $description='', $actors='',$director='',$imagefile='',$movielength=''){
            if($id_movie !='' && $moviename !='' && $nation != ''&& $description!='' && $actors!='' && $director!='' && $imagefile !='' && $movielength !=''){
                $this->id_movie = $id_movie;
                $this->moviename = $moviename;
                $this->nation = $nation;
                $this->description = $description;
                $this->actors = $actors;
                $this->director = $director;
                $this->imagefile = $imagefile;
                $this->movielength = $movielength;
            }
        }

        public static function getAll($conn){
            try{
                $sql = "select * from movies;";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
               if($stmt->execute()){
                    $movie = $stmt->fetchAll();
                    return $movie;
               }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function getId($conn, $id_movie){
            try{
                $sql = "select * from movies where id_movie=:id_movie;";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
                if($stmt->execute()){
                    $book = $stmt->fetch();
                    return $book;
                } 
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getMovieGenres($conn){
            try{
                $sql = "select namegenre from moviegenres join genres 
                on moviegenres.id_genre = genres.id_genre
                WHERE id_movie=:id_movie";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id_movie', $this->id_movie,PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $category = "";
                $stmt->execute();
                $rows = $stmt->fetchAll();
                for($i = 0; $i < count($rows); $i++){
                    if($i == count($rows) - 1){
                        $category = $category . $rows[$i]['namegenre'];   // Lấy dòng thứ i côt namegenre ...
                    }else{
                        $category = $category . $rows[$i]['namegenre'] . ", ";
                    }
                }
                return $category;
            }catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }

        //Phân trang:
        public function count($conn){
            try{
                $sql = "select count(id_movie) from movies;";
                return $conn->query($sql)->fetchColumn();
            }catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }

        public static function getPaging($conn, $limit, $offset){
            try{
                // Hiển thị limit record từ dòng offer
                $sql = "select * from movies order by moviename asc
                limit :limit 
                offset :offset;";

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
                if($stmt->execute()){
                    $movie = $stmt->fetchAll();
                    return $movie;
                }
            }catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }

    }
?>