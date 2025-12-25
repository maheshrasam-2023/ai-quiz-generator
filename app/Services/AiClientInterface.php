<?php

namespace App\Services;

interface AiClientInterface
{
    public function generate(string $prompt): string;
}