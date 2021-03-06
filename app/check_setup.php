<?php

// PHP 5.3.3 minimum
if (version_compare(PHP_VERSION, '5.3.3', '<')) {
    die('This software require PHP 5.3.3 minimum');
}

// Checks for PHP < 5.4
if (version_compare(PHP_VERSION, '5.4.0', '<')) {

    // Short tags must be enabled for PHP < 5.4
    if (! ini_get('short_open_tag')) {
        die('This software require to have short tags enabled if you have PHP < 5.4 ("short_open_tag = On")');
    }

    // Magic quotes are deprecated since PHP 5.4
    if (get_magic_quotes_gpc()) {
        die('This software require to have "Magic quotes" disabled, it\'s deprecated since PHP 5.4 ("magic_quotes_gpc = Off")');
    }
}

// Check extension: PDO
if (! extension_loaded('pdo_sqlite') && ! extension_loaded('pdo_mysql') && ! extension_loaded('pdo_pgsql')) {
    die('PHP extension required: pdo_sqlite or pdo_mysql or pdo_pgsql');
}

// Check extension: mbstring
if (! extension_loaded('mbstring')) {
    die('PHP extension required: mbstring');
}

// Check if /data is writeable
if (! is_writable('data')) {
    die('The directory "data" must be writeable by your web server user');
}

// Fix wrong value for arg_separator.output, used by the function http_build_query()
if (ini_get('arg_separator.output') === '&amp;') {
    ini_set('arg_separator.output', '&');
}

// Prepare folder for uploaded files
if (! is_dir(FILES_DIR)) {
    if (! mkdir(FILES_DIR, 0755, true)) {
        die('Unable to create the upload directory: "'.FILES_DIR.'"');
    }
}

// Check permissions for files folder
if (! is_writable(FILES_DIR)) {
    die('The directory "'.FILES_DIR.'" must be writeable by your webserver user');
}
