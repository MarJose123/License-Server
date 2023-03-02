<?php

namespace App\Helpers;

class LicenseKeyGenerator
{
    protected ?string $numbers = '0123456789';
    protected ?string $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected ?string $pattern;
    protected ?array $existing_keys;

    public function __construct()
    {
        $this->pattern = config('license-server.License_key.pattern');

    }

    private function generate(): string
    {
        mb_internal_encoding('UTF-8');

        $numbers = $this->numbers;
        $letters = $this->letters;
        $characters = $numbers . $letters;
        $pattern = $this->pattern;

        $generated_key = "";
        for ($x = 0; $x < mb_strlen($pattern); $x++) {
            $generated_key .= match ($pattern[$x]) {
                "N" => $numbers[rand(0, mb_strlen($numbers) - 1)],
                "L" => $letters[rand(0, mb_strlen($letters) - 1)],
                "X" => $characters[rand(0, mb_strlen($characters) - 1)],
                default => $pattern[$x],
            };
        }
        return $generated_key;
    }

    /**
     * @throws \Exception
     */
    public function generateUnique(): string
    {
        $existing_keys = $this->existing_keys;
        $generated_key = $this->generate();
        $keys_list = [];
        while (in_array($generated_key, $existing_keys)) {
            $generated_key = $this->generate();
            $keys_list[] = $generated_key;
            if (self::compareKeys($existing_keys, $keys_list)) {
                throw new \Exception('No more keys available', 406);
            }
        }
        return $generated_key;
    }

    private function compareKeys($existing_keys, $keys_list): bool
    {
        $compare1 = array_diff($existing_keys, $keys_list);
        $compare2 = array_diff($keys_list, $existing_keys);
        if (sizeof($compare1) == 0 && sizeof($compare2) == 0) {
            return true;
        } else {
            return false;
        }
    }



}
