<?php

class Animal {
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
        <form action=\"request-battle.php\" method=\"POST\">
            <div class=\"card\">
                <div>
                    <img src=\"../$this->link\">
                </div>
                <input type=\"hidden\" id=\"id\" name=\"id\" required value=\"$this->id\">
                <input type=\"hidden\" id=\"alias\" name=\"alias\" required value=\"$this->alias\">
                <div class=\"card-content\">
                    <p>Nombre: $this->alias</p>
                    <ul>
                        <li>Experiencia: $this->exp</li>
                        <li>Nivel: $this->level</li>
                        <li>Ataque: $this->atk</li>
                        <li>Puntos de salud: $this->ps</li>
                    </ul>
                    <button type=\"submit\" name=\"play\">Mandar a batalla</button>
                </div>
            </div>
        </form>
        ";
        return $html;
    }

    public function update_exp($conn, $id_user, $exp){
        $level_up = 0;
        $this->exp += $exp;
        while($this->exp >= 100){
            $level_up++;
            $this->exp -= 100;
        }
        
        $sql = "UPDATE Players_animals SET exp = ?, level = level + ? WHERE id = ? AND id_owner = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $this->exp, $level_up, $this->id, $id_user);
        $stmt->execute();
    }
    
}

?>
