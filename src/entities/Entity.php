<?php

declare(strict_types = 1);

class Entity {
    public $idfr_code; // Identifier code.
    public string $desc = ""; // Description.

    public function __construct(int $idfr_code) {
        $this->idfr_code = $idfr_code;
    }
}

?>
