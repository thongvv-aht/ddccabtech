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
if ($_POST['first-name'] && $_POST['last-name'] && $_POST['email'] && $_POST['company']) {
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
	$first_name = $_POST['first-name'];
	$last_name = $_POST['last-name'];
	$email = $_POST['email'];
	$company = $_POST['company'];

	$str_post = "email=" . urlencode($email)
		. "&first_name=" . urlencode($first_name)
		. "&last_name=" . urlencode($last_name)
		. "&company=" . urlencode($company);
	
	$product_interest = '';
	if (isset($_POST['Product_Interest']) && is_array($_POST['Product_Interest']) && count($_POST['Product_Interest'])) {
		$product_interest = implode(';', $_POST['Product_Interest']);
	}
	$str_post .= '&Product_Interest=' . urlencode($product_interest);
		
	$str_post .= "&lead_source=Website"
		. "&hs_context=" . urlencode($hs_context_json); //Leave this one be

	//replace the values in this URL with your portal ID and your form GUID
	$endpoint = 'https://a40632.actonsoftware.com/acton/eform/40632/a06f7ada-1913-4c90-9582-502d005e62c9/d-ext-0001';

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