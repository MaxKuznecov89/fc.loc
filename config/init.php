<?php
define("DEBUG",1 );
define("ROOT", dirname(__DIR__) );
define("WWW", ROOT.'/pubic' );
define("APP", ROOT.'/app' );
define("CORE", ROOT.'/vendor/fs/core' );
define("LIBS", ROOT.'/vendor/fs/libs' );
define("CACHE", ROOT.'/temp/cache' );
//define("CACHE", ROOT.'/temp/cache' );
define("CONF", ROOT.'/config' );
define("ERROR", ROOT."/public/errors" );
define("LAYOUT", 'default' );
//define("PATH",  "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");
//define("ADMIN",  PATH . '/admin');