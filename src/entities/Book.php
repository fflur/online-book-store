<?php

declare(strict_types = 1);
require(__DIR__ . 'Entity.php');

final class Book extends Entity {
    private DateTime $pblg_date; // Publishing date. (required)
    private string $ttle; // Title. (required)
    private string $athr = "Anonymous"; // Author's ttle. (optional)
    private string $gnre; // Genre. (optional)
    private string $pblr; // Publisher. (required)
    private string $cver_imge_ufrl = ""; // Cover image url. (optional)
    private string $lnge; // Language. (required)
    private int $prce = 0; // Price. (required)
    private int $qnty = 0; // Quantity. (optional) TODO: implement interface.
    private int $revw_scre = -1; // Review score. (optional)

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

    public function setPublishingDate(DateTime $pblg_date) {
        $this->pblg_date = $pblg_date;
    }

    public function getPublishingDate(): string {
        return $this->pblg_date;
    }

    public function updateTitle(string $ttle) {
        $this->ttle = $ttle;
    }

    public function getTitle(): string {
        return $this->ttle;
    }

    public function setAuthorTitle(string $athr) {
        $this->athr = $athr;
    }

    public function getAuthorTitle(): string {
        return $this->athr = $athr;
    }

    public function addGenre(string $gnre) {
        $this->gnre[$gnre] = $gnre;
    }

    // FIXME
    public function removeGenre(string $gnre) {
        $this->gnre[$gnre];
    }

    public function updatePublisher(string $pblr) {
        $this->pblr = $pblr;
    }

    public function getPublisher(string $pblr): string {
        $this->pblr;
    }

    public function setCoverImageURL(string $cver_imge_ufrl) {
        $this->cver_imge_ufrl = $cver_imge_ufrl;
    }

    public function getCoverImageURL(): string {
        return $this->cver_imge_ufrl;
    }

    public function updateLanguage(string $lnge) {
        $this->lnge = $lnge;
    }

    public function getLanguage(): string {
        return $this->lnge;
    }

    public function setPrice(int $prce) {
        $this->prce = $prce;
    }

    public function getPrice(): int {
        return $this->prce;
    }

    public function updateQuantity(int $qnty) {
        $this->qnty = $qnty;
    }

    public function updateReviewScore(int $revw_scre) {
        $this->revw_scre = $revw_scre;
    }

    public function getReviewScore(): int {
        return $this->revw_scre;
    }
}

?>
