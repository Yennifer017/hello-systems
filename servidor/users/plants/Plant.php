<?php
class Plant{
    public $id = -1;
    public $cost = '';
    public $atk = '';
    public $ps = '';
    public $link = '';
    public $name = '';
    public $exp = '';

    
    public function __construct($id, $cost, $atk, $ps, $exp, $link, $name) {
        $this->id = $id;
        $this->cost = $cost;
        $this->atk = $atk;
        $this->ps = $ps;
        $this->exp = $exp;
        $this->link = $link;
        $this->name = $name;
    }

    public function show_form()  {
        $html ="
        <form>
            <div class=\"card\">
                <div>
                    <img src=\"../$this->link\">
                </div>
                <input type=\"hidden\" id=\"id\" name=\"id\" required value=\"$this->id\">
                <div class=\"card-content\">
                    <p>Nombre: $this->name</p>
                    <ul>
                        <li>Costo: $this->cost</li>
                        <li>+ Ataque: $this->atk</li>
                        <li>+ Puntos de salud: $this->ps</li>
                        <li>+ Exp: $this->exp</li>
                    </ul>
                    <button>Comprar</button>
                </div>
            </div>
        </form>
        ";
        return $html;
    }
}
