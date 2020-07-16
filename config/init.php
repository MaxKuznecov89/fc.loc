<?php
define("DEBUG",1 );
define("ROOT", dirname(__DIR__) );
define("WWW", ROOT.'/pubic' );
define("APP", ROOT.'/app' );
define("CORE", ROOT.'/vendor/core' );
define("LIBS", ROOT.'/vendor/libs' );
define("CACHE", ROOT.'/temp/cache' );
//define("CACHE", ROOT.'/tmp/cache' );
define("CONF", ROOT.'/config' );
define("LAYOUT", 'default' );
//define("PATH",  "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");
//define("ADMIN",  PATH . '/admin');