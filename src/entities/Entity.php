<?php

class Entity {
    private ?string $desc;

    public function __construct(?string $desc = null) {
        $this->desc = $desc;
    }

    public function GetDescription(): ?string {
        return $this->desc;
    }

    public function SetDescription(?string $desc): void {
        $this->desc = $desc;
    }
}

?>
