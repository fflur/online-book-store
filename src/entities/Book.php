<?php

declare(strict_types = 1);
require_once __DIR__ . '/Entity.php';

class Book extends Entity {
    private int $id;
    private int $edtn;
    private int $pblg_year;
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
        int $id,
        int $edtn,
        int $pblg_year,
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
        $this->id = $id;
        $this->edtn = $edtn;
        $this->pblg_year = $pblg_year;
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

    public function GetId(): int {
        return $this->id;
    }

    public function GetEdition(): int {
        return $this->edtn;
    }

    public function SetEdition(int $edtn): void {
        $this->edtn = $edtn;
    }

    public function GetPblgYear(): int {
        return $this->pblg_year;
    }

    public function SetPblgYear(int $pblg_year): void {
        $this->pblg_year = $pblg_year;
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
