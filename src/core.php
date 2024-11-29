<?php declare(strict_types = 1);

class Book {
    private DateTime $pblg_date; // Publishing date.
    private string $ttle; // Title.
    private string $athr = "Anonymous"; // Author's ttle.
    private string $gnre; // Genre.
    private string $desc = ""; // Description.
    private string $pblr; // Publisher.
    private string $cver_imge_ufrl = ""; // Cover image url.
    private string $lnge; // Language.
    private int $idty_code; // Identification code.
    private int $prce; // Price.
    private int $qnty = 0; // Quantity.
    private int $revw_scre = -1; // Review score.

    // These parameters are required.
    public function __construct(
        string $pblg_date, // This should of the form: yyyy-mm-dd
        string $ttle,
        string $pblr,
        string $lnge,
        int $idty_code,
        int $prce,
    ) {
        $this->idty_code = $idty_code;
        $this->pblg_date = new DateTime($pblg_date);
        $this->ttle = $ttle;
        $this->prce = $prce;
        $this->pblr = $pblr;
        $this->lnge = $lnge;
    }

    public function setAuthorTitle(string $athr) {
        $this->athr = $athr;
    }

    public function addGenre(string $gnre) {
        $this->gnre[] = $gnre;
    }

    public function setDescription(string $desc) {
        $this->desc = $desc;
    }

    public function setCoverImageURL(string $cver_imge_ufrl) {
        $this->cver_imge_ufrl = $cver_imge_ufrl;
    }

    public function setPrice(int $prce) {
        $this->prce = $prce;
    }

    public function updateQuantity(int $qnty) {
        $this->qnty = $qnty;
    }

    public function updateReviewScore(int $revw_scre) {
        $this->revw_scre = $revw_scre;
    }
}

class User {
    protected int $idfr; // ID.
    protected int $phne_nmbr; // Phone number.
    protected string $stte; // State.
    protected string $city;
    protected string $user_name; // User name.
    protected string $mail_addr; // Email address.

    public function __construct(
        int $idfr,
        int $phne_nmbr,
        string $stte,
        string $city,
        string $user_name,
        string $mail_addr,
    ) {
        $this->idfr = $idfr;
        $this->phne_nmbr = $phne_nmbr;
        $this->stte = $stte;
        $this->city = $city;
        $this->user_name = $user_name;
        $this->mail_addr = $mail_addr;
    }
}

class Owner extends User {
    private string $frst_name; // Required.
    private string $mdle_name; // Optional.
    private string $last_name; // Required.

    public function __construct(
        int $idfr,
        int $phne_nmbr,
        string $stte,
        string $city,
        string $user_name,
        string $mail_addr,
        string $frst_name,
        string $last_name,
    ) {
        parent::__construct(
            $idfr,
            $phne_nmbr,
            $stte,
            $city,
            $user_name,
            $mail_addr,
        );

        $this->frst_name = $frst_name;
        $this->last_name = $last_name;
    }

    public function setFirstName(string $frst_name) {
        $this->frst_name = $frst_name;
    }

    public function setMiddleName(string $mdle_name) {
        $this->mdle_name = $mdle_name;
    }

    public function setLastName(string $last_name) {
        $this->last_name = $last_name;
    }

    public function getFirstName(): string {
        return $this->frst_name;
    }

    public function getMiddleName(): string {
        return $this->mdle_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }
}

// Customer is anyone who buys a book.
class Customer extends User {
    private string $frst_name; // Required.
    private string $mdle_name; // Optional.
    private string $last_name; // Required.
}

// Member is a customer who gets notifications about offers instantly.
class Member extends Customer {
    private bool $is_member;
}

?>
