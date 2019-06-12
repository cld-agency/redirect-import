<?php

// Load all PHP files in this folder. This isn't a great way of doing this, but
// for the purpose of the experiment it'll do.
foreach (glob(__DIR__ . '/*.php') as $filename) {
    include_once $filename;
}
