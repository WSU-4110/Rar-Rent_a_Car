<?php
class Car {
    private $id;
    private $type;
    private $color;
    private $condition;

    public function __construct($id, $type, $color, $condition) {
        $this->id = $id;
        $this->type = $type;
        $this->color = $color;
        $this->condition = $condition;
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    public function getType() {
        return $this->type;
    }
    public function getColor() {
        return $this->color;
    }
    public function getCondition() {
        return $this->condition;
    }

    // Setters
    public function setType($type) {
        $this->type = $type;
    }
    public function setColor($color) {
        $this->color = $color;
    }
    public function setCondition($condition) {
        $this->condition = $condition;
    }
}
?>
