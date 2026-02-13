<?php
    $title= '02 - Construct';
    $description ='Special method that initializes a new object upon creation.';

    include_once 'template/header.php';
    echo "<section>";

    class playlist{
        public $name;
        public $artist=array();
        public $album=array();
        public $genre=array();
        public $image=array();
        public $year=array();

        public function __construct($name){
            $this->name=$name;
        }

        public function setPlayList($artist,$album, $genre, $image, $year){
            $this->artist[] = $artist;
            $this->album[] = $album;
            $this->genre[] = $genre;
            $this->image[] = $image;
            $this->year[] = $year;
        }

        public function getPlayList() {
            echo "<h3> PlayList: $this->name </h3>";
            echo "<div style='display: flex; gap: 2rem; flex-direction: column'>";
                    for($i = 0; $i < count($this->artist); $i++) {
                        echo "<div style='display: flex; gap: 1rem'>";
                            echo "<img src='".$this->image[$i]."' width='120px'>";
                            echo "<div>";
                                echo "<h4> Artist: ".$this->artist[$i]."</h4>";
                                echo "<h5> Genre: ".$this->genre[$i]."</h5>";
                                echo "<h5> Year: ".$this->year[$i]."</h5>";
                            echo "</div>";
                        echo "</div>";
                    }
             echo   "</div>";
        }
    }

    $pl = new playlist('Feliz Navidad');
    $pl->setPlayList('Mariah Carey','Merry Crismas','Pop-Holiday','https://shorturl.at/jOZJu','1994');
    $pl->setPlayList('Wham','Music from the Edge of heaven','Pop','https://shorturl.at/T8mQQ','1994');
    $pl->setPlayList('Rodolfo Aicardi','Rodolfo Aicardi y Su Tipica Ra7','Cumbia','https://shorturl.at/KiulU','1979');

    $pl->getPlayList();

 

    include_once 'template/footer.php';