<?php
$title = '08 - Overwrite Construct';
$description = 'Redefining the constructor method in a child class.';

include_once 'template/header.php';
echo '<section>';

class VideoGame{
    protected $name;
    protected $platform;
    protected $year;

    public function __construct($name, $platform)
    {
        $this->name =$name;
        $this->platform =$platform;
    }
}

class Game extends VideoGame{

    public function __construct($name, $platform, $year)
    {
        parent::__construct($name, $platform);
        $this->year =$year;
    }

    public function showVideoGame(){
        Echo "<ul><li>Name: {$this->name}<br>
                    Platform: {$this->platform}<br>
                    year: {$this->year}</li></ul>";
    }
}

$gm=new Game('Halo Infinite', 'Xbox Series X',2021);
$gm->showVideoGame();

$gm=new Game('Metroid Prime 4', 'Play Station 5',2025);
$gm->showVideoGame();

$gm=new Game('Hollow Knight: Slik Song', 'Nintendo Switch', 2025);
$gm->showVideoGame();

include_once 'template/footer.php';