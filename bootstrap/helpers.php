<?php

function get_db_config()
{
	if (getenv('IS_IN_HEROKU')) {
		$url = parse_url(getenv('DATABASE_URL'));

		return $dbConfig = [
            'connection' => 'pgsql',
            'host'       => $url['host'],
            'database'   => $url['database'],
            'username'   => $url['username'],
            'password'   => $url['pass']
		];
	} else {
        return $dbConfig = [
            'connetion' => env('DB_CONNECTION', 'mysql'),
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSOWRD', '')
        ];
    }
}

?>
