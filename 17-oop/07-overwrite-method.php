<?php
$title = '07 - Overwrite Method';
$description = 'Redefining a parent classs method in the child class.';

include_once 'template/header.php';
echo '<section>';

class VideoGame{
    protected $name;
    protected $platform;

    public function __construct($name, $platform)
    {
        $this->name =$name;
        $this->platform =$platform;
    }

    public function showVideoGame(){
        echo "Platform: {$this->platform}</li></ul>";
    }

}

class Game extends VideoGame{
    public function showVideoGame(){
        Echo "<ul><li>Name: {$this->name}<br>";
        parent::showVideoGame();
    }
}

$gm=new Game('Hollow Knight: Slik Song', 'Nintendo Switch');
$gm->showVideoGame();

$gm=new Game('Metroid Prime 4', 'Nintendo Switch');
$gm->showVideoGame();

$gm=new Game('Death Strandin Z', 'Play Station 5');
$gm->showVideoGame();

$gm=new Game('Expedition 33', 'Xbox Series X');
$gm->showVideoGame();

include_once 'template/footer.php';