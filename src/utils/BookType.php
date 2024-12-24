<?php

enum BookType {
    // Fiction
    case Classic;
    case Crime;
    case Fantasy;
    case Horror;
    case HistoricalFiction;
    case Mystery;
    case Poetry;
    case Plays;
    case ScienceFiction;
    case ShortStories;
    case Thrillers;
    case War;

    // Non Fiction
    case Autobiography;
    case Memoir;
    case Essay;
    case Academic;
    case SelfHelp;

    public static function ListCategories(): array {
        return [
            'fiction' => [
                self::Classic,
                self::Crime,
                self::Fantasy,
                self::Horror,
                self::HistoricalFiction,
                self::Mystery,
                self::Poetry,
                self::Plays,
                self::ScienceFiction,
                self::ShortStories,
                self::Thrillers,
                self::War,
            ],

            'non_fiction' => [
                self::Autobiography,
                self::Memoir,
                self::Essay,
                self::Academic,
                self::SelfHelp,
            ],
        ];
    }

    public static function IsCategory(string $category): bool {
        foreach (self::cases() as $case)
            if ($case->name === $category) return true;
        return false;
    }
}

?>
