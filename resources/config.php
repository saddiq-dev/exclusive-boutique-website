<?php

// Define a constant for the directory separator (DS) for file path consistency
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

// Define a constant for the front-end templates directory
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

// Define a constant for the back-end templates directory
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");
