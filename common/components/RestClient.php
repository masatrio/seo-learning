<?php
namespace common\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\ErrorException;
use yii\web\NotFoundHttpException;
if (!function_exists('http_parse_headers')) {
	function http_parse_headers($raw_headers)
	{
		$headers = array();
		$key = ''; // [+]

		foreach(explode("\n", $raw_headers) as $i => $h)
		{
			$h = explode(':', $h, 2);
			if (isset($h[1]))
			{
				if (!isset($headers[$h[0]]))
				$headers[$h[0]] = trim($h[1]);
				elseif (is_array($headers[$h[0]]))
				{
					// $tmp = array_merge($headers[$h[0]], array(trim($h[1]))); // [-]
					// $headers[$h[0]] = $tmp; // [-]
					$headers[$h[0]] = array_merge($headers[$h[0]], array(trim($h[1]))); // [+]
				}
				else
				{
					// $tmp = array_merge(array($headers[$h[0]]), array(trim($h[1]))); // [-]
					// $headers[$h[0]] = $tmp; // [-]
					$headers[$h[0]] = array_merge(array($headers[$h[0]]), array(trim($h[1]))); // [+]
				}

				$key = $h[0]; // [+]
			}
			else // [+]
			{ // [+]
				if (substr($h[0], 0, 1) == "\t") // [+]
				$headers[$key] .= "\r\n\t".trim($h[0]); // [+]
				elseif (!$key) // [+]
				$headers[0] = trim($h[0]); // [+]
			} // [+]
		}

		return $headers;
	}
}

/**
* PHP REST Client build with cURL
*
* @author Fabio Agostinho Boris <fabioboris@gmail.com>
*/
if (!class_exists('RestClient')) {
class RestClient extends Component
{
	public	$host = 'https://api.dataforseo.com/';
	public	$port;
	public	$post_type = 'json';
	public	$timeout = 60;
	private $token;       // Auth token
	private $ba_user;
	private $ba_password;
	public $last_url = '';

	public function __construct($ba_user = null, $ba_password = null)
	{
		$host = 'https://api.dataforseo.com/';
		$arr_h = parse_url($host);
		if (isset($arr_h['port'])) {
			$this->port = (int)$arr_h['port'];
			$this->host = str_replace(":".$this->port, "", $host);
		} else {
			$this->port = null;
			$this->host = $host;
		}
		$this->token = null;
		$this->ba_user = 'ajisatriyomaulana@gmail.com';
		$this->ba_password = 'KABdoYmEOz5cFT9j';
	}

	/**
	* Returns the absolute URL
	*
	* @param string $url
	*/
	private function url($url = null)
	{
		$_host = rtrim($this->host, '/');
		$_url = ltrim($url, '/');

		return "{$_host}/{$_url}";
	}

	/**
	* Returns the URL with encoded query string params
	*
	* @param string $url
	* @param array $params
	*/
	private function urlQueryString($url, $params = null)
	{
		$qs = array();
		if ($params) {
			foreach ($params as $key => $value) {
				$qs[] = "{$key}=" . urlencode($value);
			}
		}

		$url = explode('?', $url);
		if (isset($url[1])) $url_qs = $url[1];
		$url = $url[0];
		if (isset($url_qs)) $url = "{$url}?{$url_qs}";

		if (count($qs)) return "{$url}?" . implode('&', $qs);
		else return $url;
	}

	/**
	* Make an HTTP request using cURL
	*
	* @param string $verb
	* @param string $url
	* @param array $params
	*/
	private function request($verb, $url, $params = array())
	{

		$ch = curl_init();       // the cURL handler
		$url = $this->url($url); // the absolute URL
		$request_headers = array();
		if (!empty($this->token)) {
			$request_headers[] = "Authorization: {$this->token}";
		}

		if ((!empty($this->ba_user)) AND (!empty($this->ba_password))) {
			curl_setopt($ch, CURLOPT_USERPWD, $this->ba_user . ":" . $this->ba_password);
		}

		// encoded query string on GET
		switch (true) {
			case 'GET' == $verb:
			$url = $this->urlQueryString($url, $params);
			$this->last_url = $url;
			break;
			case in_array($verb, array('POST', 'PUT', 'DELETE')):
			if ($this->post_type == 'json') {
				$request_headers[] = 'Content-Type: application/json';
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
			} else {
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			}
		}

		// set the URL
		curl_setopt($ch, CURLOPT_URL, $url);

		// set the HTTP verb for the request
		switch ($verb) {
			case 'POST':
			curl_setopt($ch, CURLOPT_POST, true);
			break;
			case 'PUT':
			case 'DELETE':
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
		}

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		if (!empty($this->port)) {
			curl_setopt($ch, CURLOPT_PORT, $this->port);
		}

		$response = curl_exec($ch);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$headers = http_parse_headers(substr($response, 0, $header_size));
		$response = substr($response, $header_size);
		$http_code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
		$content_error = curl_error($ch);

		curl_close($ch);

		if (strpos($content_type, 'json')) $response = json_decode($response, true);

		switch (true) {
			case 'GET' == $verb:
			//if ($http_code !== 200) {
			//	$this->throw_error($response, $http_code);
			//}
			return $response;
			case in_array($verb, array('POST', 'PUT', 'DELETE')):
			//if (($http_code !== 303) AND ($http_code !== 200)) {
				//$this->throw_error($response, $http_code);
			//}
			if ($http_code === 200) {
				return $response;
			} else {
				try {
				return str_replace(rtrim($this->host, '/') . '/', '', $headers['Location']);
				} catch (ErrorException $e) {
			throw new NotFoundHttpException('Koneksi bermasalah atau data tidak ditemukan, silahkan periksa koneksi internet atau coba kata kunci lainnya.');
			}
			}
		}
	}


	/**
	* Make an HTTP GET request
	*
	* @param string $url
	* @param array $params
	*/
	public function get($url, $params = array())
	{
		return $this->request('GET', $url, $params);
	}

	/**
	* Make an HTTP POST request
	*
	* @param string $url
	* @param array $params
	*/
	public function post($url, $params = array())
	{
		return $this->request('POST', $url, $params);
	}

	/**
	* Make an HTTP PUT request
	*
	* @param string $url
	* @param array $params
	*/
	public function put($url, $params = array())
	{
		return $this->request('PUT', $url, $params);
	}

	/**
	* Make an HTTP DELETE request
	*
	* @param string $url
	* @param array $params
	*/
	public function delete($url, $params = array())
	{
		return $this->request('DELETE', $url, $params);
	}
}
}
