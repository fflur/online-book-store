<?php declare(strict_types = 1);

require("utils.php");

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

class User extends Entity {
    private int $phne_nmbr; // Phone number.
    private string $stte; // State.
    private string $city;
    private string $user_name; // Unique.
    private string $mail_addr; // Email address.

    public function __construct(
        int $idfr_code,
        int $phne_nmbr,
        string $stte,
        string $city,
        string $user_name,
        string $mail_addr,
    ) {
        parent::__construct($idfe_code);
        $this->idfr = $idfr;
        $this->phne_nmbr = $phne_nmbr;
        $this->stte = $stte;
        $this->city = $city;
        $this->user_name = $user_name;
        $this->mail_addr = $mail_addr;
    }

    final public function updatePhoneNumber(int $phne_nmbr) {
        $this->phne_nmbr = $phne_nmbr;
    }

    final public function getPhoneNumber(): string {
        return $this->phne_nmbr;
    }

    final public function updateState(string $stte) {
        $this->stte = $stte;
    }

    final public function getState(): string {
        return $this->stte;
    }

    final public function updateCity(string $city) {
        $this->city = $city;
    }

    final public function getCity(): string {
        return $this->city;
    }

    final public function updateUserName(string $user_name) {
        $this->user_name= $user_name;
    }

    final public function getUserName(): string {
        return $this->user_name;
    }

    final public function updateMailAddr(string $mail_addr) {
        $this->mail_addr= $mail_addr;
    }

    final public function getMailAddr(): string {
        return $this->mail_addr;
    }
}

final class Owner extends User {
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

// Customer is anyone who wanna buy a book.
class Customer extends User {
    private string $frst_name; // Required.
    private string $mdle_name; // Optional.
    private string $last_name; // Required.

    public function __construct(string $frst_name, string $last_name) {
        $this->frst_name = $frst_name;
        $this->last_name = $last_name;
    }

    final public function updateFirstName(string $frst_name) {
        $this->frst_name = $frst_name;
    }

    final public function getFirstName() {
        return $this->frst_name;
    }

    final public function setMiddleName(string $mdle_name) {
        $this->mdle_name= $mdle_name;
    }

    final public function getMiddleName() {
        return $this->mdle_name;
    }

    final public function updateLastName(string $last_name) {
        $this->last_name = $last_name;
    }

    final public function getLastName() {
        return $this->last_name;
    }
}

// Member is a customer who gets notifications about offers instantly.
class Member extends Customer {
    private bool $is_member;
}

?>
