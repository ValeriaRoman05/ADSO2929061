<?php
    class controller {
        public $load;
        public $model;

        public function __construct() {
            $this->load = new load;
            $this->model = new model;

            $this->handleRequest();
        }

        private function handleRequest() {
            $pokemons = $this->model->listPokemons();
            $this->load->view('welcome.php' , $pokemons);
        }
    }