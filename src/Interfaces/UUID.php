<?php

namespace CLD\RedirectImport\Interfaces;

interface UUID
{
    /**
     * Generate a UUID key.
     *
     * @return string
     */
    public function generate(): string;
}
