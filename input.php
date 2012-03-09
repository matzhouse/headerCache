<?php

	if ( isset( $_POST['submit'] ) ) {
		

		$memcache = new Memcache;
		$memcache->connect('localhost', 11211) or die ("Could not connect");

		// create the memcache payload
		$headercode = $_POST['headercode'];

		$payload = $_POST['data'];

		$contents_array = array(
			'headers' => $headercode,
			'payload' => $payload
			);

		$contents = json_encode($contents_array);

		$key = $_POST['key'];

		if ($memcache->set($key, $contents, 0, 0) ) {
			echo 'Saved..';
		}



	}

?>

<form action="input.php" method="POST">

<p>
<textarea name="data" cols="60" rows="20"></textarea>
</p>

<p>
Key<br />
<input type="text" name="key" value="" />
</p>

<p>
Header code<br />
<input type="text" name="headercode" value="" />
</p>

<input type="submit" name="submit" value="Add page" />

</form>

