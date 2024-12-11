<?php

declare(strict_types = 1);
require(__DIR__ . '/Entity.php');

final class Book extends Entity {
    public DateTime $pblg_date; // Publishing date. (required)
    public string $ttle; // Title. (required)
    public string $athr = "Anonymous"; // Author's ttle. (optional)
    public string $gnre; // Genre. (optional)
    public string $pblr; // Publisher. (required)
    public string $cver_imge_ufrl = ""; // Cover image url. (optional)
    public string $lnge; // Language. (required)
    public int $prce = 0; // Price. (required)
    public int $qnty = 0; // Quantity. (optional) TODO: implement interface.
    public int $revw_scre = -1; // Review score. (optional)

    // These parameters are required.
    public function __construct(
        int $idfr_code,
        string $pblg_date, // This should of the form: yyyy-mm-dd
        string $ttle,
        string $pblr,
        string $lnge,
    ) {
        parent::__construct($idfr_code);
        $this->pblg_date = new DateTime($pblg_date);
        $this->ttle = $ttle;
        $this->pblr = $pblr;
        $this->lnge = $lnge;
    }
}

?>
