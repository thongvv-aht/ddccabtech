<?php
// Access vector is locked down in .htaccess
$currentPath = $_SERVER['PHP_SELF'];
$pathInfo = pathinfo($currentPath);
$hostName = $_SERVER['HTTP_HOST'];
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
	$protocol = "https://";
} else {
	$protocol = "http://";
}
$http = $protocol . $hostName;
	
//Process a new form submission in HubSpot in order to create a new Contact.
if ($_POST['email']) {
	$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
	$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
	$hs_context      = array(
		'hutk' => $hubspotutk,
		'ipAddress' => $ip_addr,
		'pageUrl' => $http . $_POST['url'],
		'pageName' => $_POST['name']
	);
	$hs_context_json = json_encode($hs_context);

	//Need to populate these variable with values from the form.
	$email = $_POST['email'];
	
	$str_post = "email=" . urlencode($email);
	$str_post .= "&lead_source=Website"
		. "&hs_context=" . urlencode($hs_context_json); //Leave this one be

	//replace the values in this URL with your portal ID and your form GUID
	$endpoint = 'https://a40632.actonsoftware.com/acton/eform/40632/c6569f84-1690-4610-a1d3-7822fda9d73c/d-ext-0001';

	$ch = @curl_init();
	@curl_setopt($ch, CURLOPT_POST, true);
	@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
	@curl_setopt($ch, CURLOPT_URL, $endpoint);
	@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/x-www-form-urlencoded'
	));
	@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response    = @curl_exec($ch); //Log the response from HubSpot as needed.
	$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
	@curl_close($ch);
	echo $status_code . " " . $response;
} else {
	echo 'field is required.';
}