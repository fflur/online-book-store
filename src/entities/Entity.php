<?php

declare(strict_types = 1);

class Entity {
    private int $idfr_code; // Identifier code.
    private string $desc = ""; // Description.

    public function __construct(int $idfr_code) {
        $this->idfr_code = $idfr_code;
    }

    final public function getIdentifierCode(): int {
        return $this->idfr_code;
    }

    final public function setDescription(string $desc) {
        $this->desc = $desc;
    }

    final public function getDescription(string $desc): string {
        return $this->desc;
    }
}

?>
