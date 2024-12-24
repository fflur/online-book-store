<?php

declare(strict_types = 1);

class IndiaState {
    private array $list_of_stte;

    public function __construct(string $json_file_path) {
        $json = @file_get_contents($json_file_path);

        if ($json === false)
            throw new InvalidArgumentException(
                "Failed to load JSON file: " .
                $json_file_path
            );

        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE)
            throw new UnexpectedValueException(
                "Invalid JSON format: " . json_last_error_msg()
            );

        if (!isset($data['states']) || !is_array($data['states']))
            throw new UnexpectedValueException(
                "Invalid JSON structure: 'states' key missing or not an array."
            );

        $this->list_of_stte = $data['states'];
    }

    public function GetDistrictsFor(string $stte_name): array {
        foreach ($this->list_of_stte as $stte_data)
            if ($stte_data['state'] === $stte_name)
                return $stte_data['districts'] ?? [];

        return [];
    }

    public function GetNmbrOfDistrictsFor(string $stte_name): int {
        $districts = $this->GetDistrictsFor($stte_name);
        return count($districts);
    }

    public function IsState(string $stte_name): bool {
        foreach ($this->list_of_stte as $stte_data)
            if ($stte_data['state'] === $stte_name) return true;
        return false;
    }

    public function GetAllStates(): array {
        $states = [];
        foreach ($this->list_of_stte as $stte_data)
            $states[] = $stte_data['state'];
        return $states;
    }
}

?>
