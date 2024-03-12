<?
class Movie
{
    public $id_movie;
    public $moviename;
    public $nation;
    public $description;
    public $actors;
    public $director;
    public $imagefile;
    public $movielength;

    private static $instance;


    public function __construct($moviename = '', $nation = '', $description = '', $actors = '', $director = '', $imagefile = '', $movielength = '')
    {
        if ($moviename != '' && $nation != '' && $description != '' && $actors != '' && $director != '' && $imagefile != '' && $movielength != '') {
            // $this->id_movie = $id_movie;
            $this->moviename = $moviename;
            $this->nation = $nation;
            $this->description = $description;
            $this->actors = $actors;
            $this->director = $director;
            $this->imagefile = $imagefile;
            $this->movielength = $movielength;
        }
    }

    // khoi tao 1 doi tuong
    public static function getInstance(
        $moviename,
        $nation,
        $description,
        $actors,
        $director,
        $imagefile,
        $movielength
    ): Movie {
        if (!self::$instance) {
            self::$instance = new self(
                $moviename,
                $nation,
                $description,
                $actors,
                $director,
                $imagefile,
                $movielength
            );
        }

        return self::$instance;
    }

    // truong bat buoc nhap va khong duoc null
    private function validate(): bool
    {
        return $this->moviename
            && $this->nation
            && $this->description && $this->actors && $this->director && $this->movielength;
    }

    public function addMovie($conn)
    {
        if ($this->validate()) {
            // Write sql query 
            // *** Đúng thự tự trong DB
            $sql = "insert into movies (moviename, nation,description, actors, director, imagefile, movielength) 
                    values (:moviename, :nation,:description, :actors, :director, :imagefile, :movielength);";

            // Prepare connection
            $stmt = $conn->prepare($sql);

            // Refence to each value
            $stmt->bindValue(':moviename', $this->moviename, PDO::PARAM_STR);
            $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindValue(':actors', $this->actors, PDO::PARAM_STR);
            $stmt->bindValue(':director', $this->director, PDO::PARAM_STR);
            $stmt->bindValue(':nation', $this->nation, PDO::PARAM_STR);
            $stmt->bindValue(':imagefile', $this->imagefile, PDO::PARAM_STR);
            $stmt->bindValue(':movielength', $this->movielength, PDO::PARAM_INT);

            return $stmt->execute();
        } else {
            return false;
        }
    }

    public static function getAll($conn)
    {
        try {
            $sql = "select * from movies;";
            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
            if ($stmt->execute()) {
                $movie = $stmt->fetchAll();
                return $movie;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkImage(){
        if(!file_exists(".". $this->imagefile)){
            $this->imagefile = "./uploads/image.png";
        }
    }

    public static function getId($conn, $id_movie)
    {
        try {
            $sql = "select * from movies where id_movie=:id_movie;";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
            if ($stmt->execute()) {
                $movie = $stmt->fetch();
                return $movie;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getMovieGenres($conn)
    {
        try {
            $sql = "select namegenre from moviegenres join genres 
                on moviegenres.id_genre = genres.id_genre
                WHERE id_movie=:id_movie";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id_movie', $this->id_movie, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $category = "";
            $stmt->execute();
            $rows = $stmt->fetchAll();
            for ($i = 0; $i < count($rows); $i++) {
                if ($i == count($rows) - 1) {
                    $category = $category . $rows[$i]['namegenre'];   // Lấy dòng thứ i côt namegenre ...
                } else {
                    $category = $category . $rows[$i]['namegenre'] . ", ";
                }
            }
            return $category;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    //Tìm kiếm
    public static function searchByName($conn, $namefilm)
    {
        if ($namefilm == "") {
            try {
                $sql = "select * from movies order by id_movie DESC;";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
                if ($stmt->execute()) {
                    $movie = $stmt->fetchAll();
                    return $movie;
                }
            } catch (PDOException $e) {
                $e->getMessage();
                return false;
            }
        } else {
            try {
                $sql = "select * from movies where moviename like '$namefilm%';";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
                if ($stmt->execute()) {
                    $movie = $stmt->fetchAll();
                    return $movie;
                }
            } catch (PDOException $e) {
                $e->getMessage();
                return false;
            }
        }
    }

    //Update
    public function update($conn)
    {
        try {
            $sql = "update movies
                       set moviename=:moviename, description=:description,
                       actors=:actors, nation=:nation, director=:director
                       where id_movie=:id_movie;";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':moviename', $this->moviename, PDO::PARAM_STR);
            $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindValue(':actors', $this->actors, PDO::PARAM_STR);
            $stmt->bindValue(':director', $this->director, PDO::PARAM_STR);
            $stmt->bindValue(':nation', $this->nation, PDO::PARAM_STR);
            $stmt->bindValue(':id_movie', $this->id_movie, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Xóa bằng id
    public function deleteById($conn){
        try {
            $sql = "delete from movies where id_movie =:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $this->id_movie, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    //Phân trang:
    //Đếm xem có bao nhiêu phim
    public static function count($conn)
    {
        try {
            $sql = "select count(id_movie) from movies;";
            return $conn->query($sql)->fetchColumn();
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public static function countByNation($conn, $nameNation)
    {
        try {
            $sql = "select count(id_movie) from movies where nation='$nameNation'";
            return $conn->query($sql)->fetchColumn();
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public static function countByLength($conn, $length)
    {
        try {
            $sql = "select count(id_movie) from movies where moviegenre='$length'";
            return $conn->query($sql)->fetchColumn();
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public static function countByGenre($conn, $genre)
    {
        try {
            $sql = "select count(id_movie) from moviegenres where id_genre='$genre'";
            return $conn->query($sql)->fetchColumn();
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public static function getPagingByLength($conn, $limit, $offset, $movielength)
    {
        try {
            // Hiển thị limit record từ dòng offer
            $sql = "select * from movies where movielength=:movielength 
                order by moviename asc
                limit :limit 
                offset :offset;";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':movielength', $movielength, PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
            if ($stmt->execute()) {
                $movie = $stmt->fetchAll();
                return $movie;
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public static function getPagingByNation($conn, $limit, $offset, $nation)
    {
        try {
            // Hiển thị limit record từ dòng offer
            // $sql = "select * from movies where nation=:nation order by moviename asc
            //     limit :limit 
            //     offset :offset;";
                $sql = "select * from movies where nation=:nation order by moviename asc
                ";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nation', $nation, PDO::PARAM_STR);
            // $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            // $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
            if ($stmt->execute()) {
                $movie = $stmt->fetchAll();
                return $movie;
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public static function getPagingByGenre($conn, $limit, $offset, $id_genre)
    {
        try {
            // Hiển thị limit record từ dòng offer
            $sql = "select * from movies WHERE id_movie in
                (select id_movie from moviegenres  where id_genre=:id_genre) order by moviename asc
                limit :limit 
                offset :offset;";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id_genre', $id_genre, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
            if ($stmt->execute()) {
                $movie = $stmt->fetchAll();
                return $movie;
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
}
