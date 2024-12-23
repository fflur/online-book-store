<?php

declare(strict_types = 1);
require_once __DIR__ . '/Entity.php';

class Book extends Entity {
    private DateTime $pblg_date;
    private int $prce;
    private int $qnty;
    private int $revw_scre;
    private string $ttle;
    private string $pblr;
    private string $lnge;
    private string $athr;
    private string $gnre;
    private ?string $cver_imge_ufrl;

    public function __construct(
        DateTime $pblg_date,
        int $prce,
        string $ttle,
        string $pblr,
        string $lnge,
        int $qnty = 0,
        int $revw_scre = -1,
        string $athr = "Anonymous",
        string $gnre = "Unknown",
        ?string $cver_imge_ufrl = null,
        ?string $desc = null
    ) {
        parent::__construct($desc);
        $this->pblg_date = $pblg_date;
        $this->prce = $prce;
        $this->qnty = $qnty;
        $this->revw_scre = $revw_scre;
        $this->ttle = $ttle;
        $this->pblr = $pblr;
        $this->lnge = $lnge;
        $this->athr = $athr;
        $this->gnre = $gnre;
        $this->cver_imge_ufrl = $cver_imge_ufrl;
    }

    public function GetPublishingDate(): DateTime {
        return $this->pblg_date;
    }

    public function SetPublishingDate(DateTime $pblg_date): void {
        $this->pblg_date = $pblg_date;
    }

    public function GetPrice(): int {
        return $this->prce;
    }

    public function SetPrice(int $prce): void {
        $this->prce = $prce;
    }

    public function GetQuantity(): int {
        return $this->qnty;
    }

    public function SetQuantity(int $qnty): void {
        $this->qnty = $qnty;
    }

    public function GetReviewScre(): int {
        return $this->revw_scre;
    }

    public function SetReviewScre(int $revw_scre): void {
        $this->revw_scre = $revw_scre;
    }

    public function GetTitle(): string {
        return $this->ttle;
    }

    public function SetTitle(string $ttle): void {
        $this->ttle = $ttle;
    }

    public function GetPublisher(): string {
        return $this->pblr;
    }

    public function SetPublisher(string $pblr): void {
        $this->pblr = $pblr;
    }

    public function GetLanguage(): string {
        return $this->lnge;
    }

    public function SetLanguage(string $lnge): void {
        $this->lnge = $lnge;
    }

    public function GetAuthor(): string {
        return $this->athr;
    }

    public function SetAuthor(string $athr): void {
        $this->athr = $athr;
    }

    public function GetGenre(): string {
        return $this->gnre;
    }

    public function SetGenre(string $gnre): void {
        $this->gnre = $gnre;
    }

    public function GetCoverImageUrl(): ?string {
        return $this->cver_imge_ufrl;
    }

    public function SetCoverImageUrl(?string $cver_imge_ufrl): void {
        $this->cver_imge_ufrl = $cver_imge_ufrl;
    }
}

?>
