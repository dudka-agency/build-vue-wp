<?php

if ( empty( $_SERVER ) ) {
	return;
}

$relations = [
	//'contact-us' => 'contact/', Example
];

$request  = trim( $_SERVER['REQUEST_URI'], '/' );
$protocol = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' )
            || ( isset( $_SERVER['SERVER_PORT'] ) && (int) $_SERVER['SERVER_PORT'] === 443 )
            || ( isset( $_SERVER['REQUEST_SCHEME'] ) && $_SERVER['REQUEST_SCHEME'] === 'https' )
            || ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' )
	? 'https'
	: 'http';

// Only for production
if ( $_SERVER['SERVER_NAME'] === 'dudka.agency' || $_SERVER['SERVER_NAME'] === 'www.dudka.agency' ) {

}

foreach ( $relations as $key => $val ) {
	if ( $key == $request ) {
		header( "HTTP/1.1 301 Moved Permanently" );
		header( "Location: $protocol://" . $_SERVER['SERVER_NAME'] . '/' . $val );
		exit();
	}
}
