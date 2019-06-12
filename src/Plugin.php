<?php

namespace CLD\RedirectImport;

class Plugin extends \craft\base\Plugin
{
    /**
     * @var bool
     */
    public $hasCpSection = true;

    /**
     * Configure the CP nav item.
     *
     * @return array
     */
    public function getCpNavItem(): array
    {
        $item         = parent::getCpNavItem();
        $item['icon'] = __DIR__ . '/icon.svg';
        return $item;
    }
}
