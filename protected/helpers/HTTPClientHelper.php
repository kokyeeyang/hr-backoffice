<?php

class HTTPClientHelper {

	public static function curl($url, $proxyType = 'HTTP', $proxyId = null, $proxyPort = null) {
		global $logger;
		$timeout = 5;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_PROXYTYPE, $proxyType);
		if (!empty($proxyId)) {
			curl_setopt($ch, CURLOPT_PROXY, $proxyId);
			curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);
			// curl_setopt($ch, CURLOPT_PROXYUSERPWD, $loginpassw);
		}
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); // timeout in seconds
		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		// print_r ( $info );
		$error = curl_error($ch);
		if ($error) {
			// echo $error;
			$logger->error($error);
		}
		// echo '$proxy_ip:' . $proxy_ip . NEWLINE;
		// echo '$proxy_port:' . $proxy_port . NEWLINE;
		// echo '$loginpassw:' . $loginpassw . NEWLINE;
		// echo 'error:' . curl_error($ch) . NEWLINE;
		// print_r($data);
		curl_close($ch);
		return $data;
	}

	public static function curl_post($url, $params) {
		global $logger;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
		// print_r ( $info );
		$error = curl_error($ch);

		if ($error) {
			// echo $error;
			$logger->debug($error);
		} else {
			//$logger->debug($data);
		}

		curl_close($ch);
		return $data;
	}

	public static function curl_get($url) {
		global $logger;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		$data = curl_exec($ch);
		
		curl_close($ch);
		
		return $data;
	}
	

}
