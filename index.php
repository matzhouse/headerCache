<?php 

$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");

$key = $_GET['id'];

if ($output = $memcache->get($key) ) {
	
	$output_contents = json_decode($output);

	switch ($output_contents->headers) {
		case '200':
			header('HTTP/1.1 200 OK');
			break;
		case '404':
			header('HTTP/1.1 404 Not Found');
			break;
		default:
			header('HTTP/1.1 200 OK');
			break;
	}

	echo $output_contents->payload;


} else {
	
	// redirect to the main page
	echo 'key not found';

}
