<?php

use Mayfifteenth\Centreforge\Settings;

// Centreforge Core depends on PSR-4 Autoload
require('autoload.php');

// Centreforge Core has global constants
require('constants.php');

// Register and load Family Archive
(static function () {
    add_action('init', static function() {
        (new Settings(__FILE__))->execute();
    });
})();