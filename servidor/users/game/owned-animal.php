<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Owned_animal {
    public $id = -1;
    public $exp = 0;
    public $level = 0;
    public $atk = 0;
    public $ps = 0;
    public $link = '';
    public $alias = '';

    
    public function __construct($id, $exp, $level, $atk, $ps, $link, $alias) {
        $this->id = $id;
        $this->exp = $exp;
        $this->level = $level;
        $this->atk = $atk;
        $this->ps = $ps;
        $this->link = $link;
        $this->alias = $alias;
    }

    public function show_form()  {
        $html ="
        <form action=\"init-game.php\" method=\"POST\">
            <div class=\"card\">
                <div>
                    <img src=\"../$this->link\">
                </div>
                <input type=\"hidden\" id=\"id\" name=\"id\" required value=\"$this->id\">
                <div class=\"card-content\">
                    <p>Nombre: $this->alias</p>
                    <ul>
                        <li>Experiencia: $this->exp</li>
                        <li>Nivel: $this->level</li>
                        <li>Ataque: $this->atk</li>
                        <li>Puntos de salud: $this->ps</li>
                    </ul>
                    <button type=\"submit\" name=\"buy\">Mandar a batalla</button>
                </div>
            </div>
        </form>
        ";
        return $html;
    }
}

?>
