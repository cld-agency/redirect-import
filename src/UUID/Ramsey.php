<?php

namespace CLD\RedirectImport\UUID;

use CLD\RedirectImport\Interfaces\UUID;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Ramsey implements UUID
{
    /**
     * @inheritDoc
     */
    public function generate(): string
    {
        return RamseyUuid::uuid4()->toString();
    }
}
