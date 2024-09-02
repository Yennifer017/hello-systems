<?php

class Animal_on_sale {
    public $id = -1;
    public $cost = '';
    public $atk = '';
    public $ps = '';
    public $link = '';
    public $name = '';

    
    public function __construct($id, $cost, $atk, $ps, $link, $name) {
        $this->id = $id;
        $this->cost = $cost;
        $this->atk = $atk;
        $this->ps = $ps;
        $this->link = $link;
        $this->name = $name;
    }

    public function show_form()  {
        $html ="
        <form action=\"buy.php\" method=\"POST\">
            <div class=\"card\">
                <div>
                    <img src=\"../$this->link\">
                </div>
                <input type=\"hidden\" id=\"id\" name=\"id\" required value=\"$this->id\">
                <div class=\"card-content\">
                    <p>Nombre: $this->name</p>

                    <label for=\"alias\">Apodo:</label>
                    <input type=\"text\" id=\"alias\" name=\"alias\" value=\"$this->name\">
                    <ul>
                        <li>Costo: $this->cost</li>
                        <li>Ataque: $this->atk</li>
                        <li>Puntos de salud: $this->ps</li>
                    </ul>
                    <button type=\"submit\" name=\"buy\">Comprar</button>
                </div>
            </div>
        </form>
        ";
        return $html;
    }
}

?>
