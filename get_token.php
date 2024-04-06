<?php
header('content-type: application/json');
$cookie = GET("cookie");
$code = GET("2fa");
$eaag = EAAG($cookie, $code);
$eaabw = EAABW($cookie);
$eaai = EAAI($cookie);
$eaabs = EAABS($cookie);
$success = array(
    "status" => "success",
    "msg" => "Get Token Thành Công",
    "data" => array(
        "token_business" => $eaag,
        "token_instagram" => $eaabw,
        "token_ads" => $eaai,
        "token_adsmanager" => $eaabs
        ));
$error = array(
    "status" => "error",
    "msg" => "Get Token Thất Bại"
    );
$json = json($success);
$jsone = json($error);
if ($json){
echo $json;
die;
}else{
echo $jsone;
die;
}
function json($data) {
	return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
function GET($data) {
	if(isset($data)) {
		$return = $_GET[$data] ? : $_POST[$data];
		return $return;
	}
}
function EAAG($cookie, $code) {
	$head = array(
		"Connection: keep-alive",
		"Keep-Alive: 300",
		"authority: m.facebook.com",
		"ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
		"accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
		"cache-control: max-age=0",
		"upgrade-insecure-requests: 1",
		"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
		"sec-fetch-site: none",
		"sec-fetch-mode: navigate",
		"sec-fetch-user: ?1",
		"sec-fetch-dest: document",
		"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36",
	);
	if (!empty($code)) {
		$ch = curl_init();
		curl_setopt_array($ch,
			array(
				CURLOPT_URL => "https://mbasic.facebook.com/",
				CURLOPT_HTTPHEADER => $head,
				CURLOPT_COOKIE => $cookie,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => true,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_CONNECTTIMEOUT => 10,
				CURLOPT_FOLLOWLOCATION => true
			)
		);
		$access = curl_exec($ch);
		curl_close($ch);
		$jazoest = explode('"', explode('name="jazoest" value="', $access)[1])[0];
		$ch = curl_init();
		curl_setopt_array($ch,
			array(
				CURLOPT_URL => "https://business.facebook.com/security/twofactor/reauth/?twofac_next=https%3A%2F%2Fbusiness.facebook.com%2Fbusiness_locations&type=avoid_bypass&app_id=0&save_device=0",
				CURLOPT_HTTPHEADER => $head,
				CURLOPT_COOKIE => $cookie,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => true,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_CONNECTTIMEOUT => 10,
				CURLOPT_FOLLOWLOCATION => true
			)
		);
		$access = curl_exec($ch);
		curl_close($ch);
		$id = explode(';', explode('c_user=', $cookie)[1])[0];
		$__dyn = "7xeUmFoO3-SudwCwRyU8EKnFwLBwCwXCwAxu13wqovzEdEnxy7Eiwzwq8S2S4okwAwSz82EyEqx60DU4m0_87Oq1eK1VgC11x-9xm1WxO4Uowuo9oeUa85vzo1eE4aUS1vwnEfU7e2l2UtggzE4y1uwiUmwnGwWx2365Ey19zUuxe0y83mwkE5G4E7K1uDwau58Gm0hi4Ejyo-3qazo8U3ywbS1bwzw";
		$__hs = explode('"', explode('haste_session":"', $access)[1])[0];
		$__rev = explode(',', explode('"client_revision":', $access)[1])[0];
		$__s = "d8znx6:e7pgwz:qt21m7";
		$__hsi = explode('"', explode('"hsi":"', $access)[1])[0];
		$fb_dtsg = explode('"', explode('"token":"', $access)[1])[0];
		$lsd = explode('"', explode('["LSD",[],{"token":"', $access)[1])[0];
		$__spin_r = explode(',', explode('__spin_r":', $access)[1])[0];
		$__spin_b = explode(',', explode('__spin_b":', $access)[1])[0];
		$__spin_t = explode(',', explode('__spin_t":', $access)[1])[0];
		$data = http_build_query(
			array(
				"approvals_code" => $code,
				"save_device" => false,
				"__user" => $id,
				"__a" => 1,
				"__dyn" => $__dyn,
				"__csr" => "",
				"__req" => 7,
				"__hs" => $__hs,
				"dpr" =>1.5,
				"__ccg" => "EXCELLENT",
				"__rev" => $__rev,
				"__s" => $__s,
				"__hsi" => $__hsi,
				"__comet_req" => 0,
				"fb_dtsg" => $fb_dtsg,
				"jazoest" => $jazoest,
				"lsd" => $lsd,
				"__spin_r" => $__spin_r,
				"__spin_b" => $__spin_b,
				"__spin_t" => $__spin_t,
				"__jssesw" => 1
			)
		);
		$_head = $head;
		$_head[] = "content-length: ".strlen($data);
		$_head[] = "referer: https://business.facebook.com/security/twofactor/reauth/?twofac_next=https%3A%2F%2Fbusiness.facebook.com%2Fbusiness_locations&type=avoid_bypass&app_id=0&save_device=0";
		$ch = curl_init();
		curl_setopt_array($ch,
			array(
				CURLOPT_URL => "https://business.facebook.com/security/twofactor/reauth/enter/",
				CURLOPT_HTTPHEADER => $_head,
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_COOKIE => $cookie,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => true,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_CONNECTTIMEOUT => 10,
				CURLOPT_FOLLOWLOCATION => true
			)
		);
		$access = curl_exec($ch);
		curl_close($ch);
	}
	$ch = curl_init();
	curl_setopt_array($ch,
		array(
			CURLOPT_URL => "https://business.facebook.com/business_locations",
			CURLOPT_HTTPHEADER => $head,
			CURLOPT_COOKIE => $cookie,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_FOLLOWLOCATION => true
		)
	);
	$access = curl_exec($ch);
	curl_close($ch);
	$access_token = 'EAAG'.explode('","', explode('EAAG', $access)[1])[0];
	if(strlen($access_token) > 5) {
		return $access_token;
	} else {
		return null;
	}
}


function EAABW($cookie){
$url = "https://m.facebook.com/dialog/oauth?encrypted_query_string=AeC8BVQ7ctjgpS9OzeGcgZu8VAHuuYRJlLKyB5NEYWlKsjPkU7BA5r0pbsXZLqw7Nlde8AWnp3Sa1XIq20qnPoHpzNEgb4qLpydMqy6CixrSTHOGiMs1-5_3j9tIeUcCV7vBUm1y_IQjy1dmjzrWzmAhtgz7scvu2CFVtSD1irg8j_73c8N4Bvpr9KxEmPgyHAcZMhhZ6zkw8Sl64BXgD1Gn8n3kPuSjQWRdCpBjqJbZyHkJuuI_fUeWrYNc6QdkdZPos3MkYQlUuEoZhFnXH7s_OytvqmIbLSHBpoPRXLSmv3UX6LNfWZp7pv0ZoOQ8v3opxbOuse0J-LvThFlu-i4mGKHHqA9TdCq2TLcAAAQzOcASfjFbs_H4E66168gYBHylPtHjsjAzUAo1ILy5p5TQvbZxrk4kpdOjhOoKj-pmOASDwXS6VH7Isup9j4eW1lAjDg-V2zo60W7Woi-HqPeliE5BiEib7lp7PBC0njUNZP8TXTD2XWUMgyO2wpHk5GYd1x1J1fSEzRzvfvQ4b8pz6f9qRfN1wXJk6Ls9wJBStJQViipbU3QGoo9v2LwuCNM9k4NHtv-1o7kPqXX0v5Vuuwbx6tN112i9_zJVbr7NafaatOR0cPt0k09wfvXdcOWOdBeAho28-aqGrwrZhga80JYJ5u5Jwxoajquxb8kEDdUjO8STzMv_9dDNUMSFyxuE-KKHdaYbnQB2AGHYQF_TkOL6Ck545wft9_dG0lMv9-XY4TOmlymzIGAG_Mt0wXM4G4wHuJ6uGzH3B0sOs0e2aVyk-Wzf14eZMs0vLIBdGyrSyt04BFupFMFAMu3WpMNJJhg87xG6_p9esk8O9Yl0kVve8CYudg-ZMZ7cXJTyXG4myoC-mJNyecUYitOdOFtShfY_WOv5-luqmbAic3nN8pWKvUdApO7uxodX-0iT1yrO26zkvZ5dkBOLkQUfEsDM-56sdOLEmKAeJXpAzuTl9cIHIlDgWHtq0iuYV48uz0ejcVovPzznIo-IwX36CAyPnlF7VvtTDec_9O1VFvWl25V56DaEunKr8A5Tx4CZPw2Z-EsGkKsW9eaGpHBgjMUHvr30vEKC8ShxthHdHN9EQhPrPyIIVGtw";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$head = array(
'authority:mbasic.facebook.com',
'sec-ch-ua:" Not A;Brand";v="99", "Chromium";v="96", "Google Chrome";v="96"',
'sec-ch-ua-mobile:?0',
'sec-ch-ua-platform:"Windows"',
'upgrade-insecure-requests:1',
'user-agent:Mozilla/5.0 (Linux; Android 11; SM-A217F Build/RP1A.200720.012;) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/104.0.5112.69 Mobile Safari/537.36',
'accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'sec-fetch-site:none',
'sec-fetch-mode:navigate',
'sec-fetch-user:?1',
'sec-fetch-dest:document',
'accept-language:vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$response = curl_exec($ch); curl_close($ch);
$dtsg = explode('"', explode('name="fb_dtsg" value="', $response)[1])[0];
$jazoest = explode('"', explode('name="jazoest" value="', $response)[1])[0];
$scope = explode('"', explode('name="scope" value="', $response)[1])[0];
$logger_id = explode('"', explode('name="logger_id" value="', $response)[1])[0];
$encrypted_post_body = explode('"', explode('name="encrypted_post_body" value="', $response)[1])[0];
$data = "fb_dtsg=".$dtsg."&jazoest=".$jazoest."&scope=".$scope."&display=touch&sdk=&sdk_version=&domain=&sso_device=ios&state=&user_code=&nonce=&logger_id=".$logger_id."&auth_type=&auth_nonce=&code_challenge=&code_challenge_method=&encrypted_post_body=".$encrypted_post_body."&return_format%5B%5D=access_token";
$urlget = "https://m.facebook.com/dialog/oauth/skip/submit/";
$header = array(
"Host: m.facebook.com",
"cache-control: max-age=0",
"upgrade-insecure-requests: 1",
"origin: https://m.facebook.com",
"content-type: application/x-www-form-urlencoded",
"user-agent: Mozilla/5.0 (Linux; Android 11; SM-A217F Build/RP1A.200720.012;) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/104.0.5112.69 Mobile Safari/537.36",
"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
"x-requested-with: mark.via.gp",
"sec-fetch-site: same-origin",
"sec-fetch-mode: navigate",
"sec-fetch-user: ?1",
"sec-fetch-dest: document",
"referer: https://m.facebook.com/dialog/oauth?encrypted_query_string=AeC8BVQ7ctjgpS9OzeGcgZu8VAHuuYRJlLKyB5NEYWlKsjPkU7BA5r0pbsXZLqw7Nlde8AWnp3Sa1XIq20qnPoHpzNEgb4qLpydMqy6CixrSTHOGiMs1-5_3j9tIeUcCV7vBUm1y_IQjy1dmjzrWzmAhtgz7scvu2CFVtSD1irg8j_73c8N4Bvpr9KxEmPgyHAcZMhhZ6zkw8Sl64BXgD1Gn8n3kPuSjQWRdCpBjqJbZyHkJuuI_fUeWrYNc6QdkdZPos3MkYQlUuEoZhFnXH7s_OytvqmIbLSHBpoPRXLSmv3UX6LNfWZp7pv0ZoOQ8v3opxbOuse0J-LvThFlu-i4mGKHHqA9TdCq2TLcAAAQzOcASfjFbs_H4E66168gYBHylPtHjsjAzUAo1ILy5p5TQvbZxrk4kpdOjhOoKj-pmOASDwXS6VH7Isup9j4eW1lAjDg-V2zo60W7Woi-HqPeliE5BiEib7lp7PBC0njUNZP8TXTD2XWUMgyO2wpHk5GYd1x1J1fSEzRzvfvQ4b8pz6f9qRfN1wXJk6Ls9wJBStJQViipbU3QGoo9v2LwuCNM9k4NHtv-1o7kPqXX0v5Vuuwbx6tN112i9_zJVbr7NafaatOR0cPt0k09wfvXdcOWOdBeAho28-aqGrwrZhga80JYJ5u5Jwxoajquxb8kEDdUjO8STzMv_9dDNUMSFyxuE-KKHdaYbnQB2AGHYQF_TkOL6Ck545wft9_dG0lMv9-XY4TOmlymzIGAG_Mt0wXM4G4wHuJ6uGzH3B0sOs0e2aVyk-Wzf14eZMs0vLIBdGyrSyt04BFupFMFAMu3WpMNJJhg87xG6_p9esk8O9Yl0kVve8CYudg-ZMZ7cXJTyXG4myoC-mJNyecUYitOdOFtShfY_WOv5-luqmbAic3nN8pWKvUdApO7uxodX-0iT1yrO26zkvZ5dkBOLkQUfEsDM-56sdOLEmKAeJXpAzuTl9cIHIlDgWHtq0iuYV48uz0ejcVovPzznIo-IwX36CAyPnlF7VvtTDec_9O1VFvWl25V56DaEunKr8A5Tx4CZPw2Z-EsGkKsW9eaGpHBgjMUHvr30vEKC8ShxthHdHN9EQhPrPyIIVGtw",
"accept-encoding: gzip, deflate",
"accept-language: vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7",
"cookie: ".$cookie
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_PORT, "443");
curl_setopt($ch, CURLOPT_URL, $urlget);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$h = curl_exec($ch);curl_close($ch);
$access_token = explode('&data', explode('#access_token=', $h)[1])[0];
if(strlen($access_token) > 5){
	return $access_token;
} else {
	return 'die';
}
}
function EAAI($cookie) {
	$head = array(
		"Connection: keep-alive",
		"Keep-Alive: 300",
		"authority: m.facebook.com",
		"ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
		"accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
		"cache-control: max-age=0",
		"upgrade-insecure-requests: 1",
		"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
		"sec-fetch-site: none",
		"sec-fetch-mode: navigate",
		"sec-fetch-user: ?1",
		"sec-fetch-dest: document",
		"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36",
	);
	$ch = curl_init();
	curl_setopt_array($ch,
		array(
			CURLOPT_URL => "https://business.facebook.com/ads/manager/account_settings/information/?pid=p1&page=account_settings&tab=account_information",
			CURLOPT_HTTPHEADER => $head,
			CURLOPT_COOKIE => $cookie,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_FOLLOWLOCATION => true
		)
	);
	$access = curl_exec($ch);
	curl_close($ch);
	$access_token = explode('"', explode('access_token:"', $access)[1])[0];
	if(strlen($access_token) > 0) {
		return $access_token;
	} else {
		return null;
	}
}
function EAABS($cookie){
    $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.facebook.com/adsmanager/manage/campaigns');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Authority: business.facebook.com';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'Sec-Ch-Ua: \"Google Chrome\";v=\"95\", \"Chromium\";v=\"95\", \";Not A Brand\";v=\"99\"';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $headers[] = 'User-Agent: ' . $useragent;
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: navigate';
    $headers[] = 'Sec-Fetch-User: ?1';
    $headers[] = 'Sec-Fetch-Dest: document';
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Cookie: ' . $cookie;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $access = curl_exec($ch);
    if (curl_errno($ch)) {
        return 'die';
    }
    curl_close($ch);


    $ch = curl_init();
    $link = explode('&nav_source', explode('campaigns?act=', $access)[1])[0];
    curl_setopt($ch, CURLOPT_URL, 'https://www.facebook.com/adsmanager/manage/campaigns?act=' . $link . '&nav_source=no_referrer');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $headers = array();
    $headers[] = 'Authority: business.facebook.com';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'Sec-Ch-Ua: \"Google Chrome\";v=\"95\", \"Chromium\";v=\"95\", \";Not A Brand\";v=\"99\"';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $headers[] = 'User-Agent: ' . $useragent;
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: navigate';
    $headers[] = 'Sec-Fetch-User: ?1';
    $headers[] = 'Sec-Fetch-Dest: document';
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Cookie: ' . $cookie;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $access1 = curl_exec($ch);
    $access_token = explode('";', explode('accessToken="', $access1)[1])[0];
    if ($access_token != '') {
        return $access_token;
    } else {
        return 'die';
    }
}
