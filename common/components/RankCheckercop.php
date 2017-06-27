<?php
namespace common\components;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
if (@ini_set('max_execution_time', 1200) !== false) {
    @ini_set('max_execution_time', 1200);
}
if (!class_exists('GoogleRankChecker')) {
    class RankChecker extends Component
    {
		public $start;
        public $end;
        
        public function __construct($start = 1, $end = 2)
        {
            $this->start = $start;
            $this->end = $end;
        }   
        
        public function find($keyword, $domain)
        {
            $results = [];
			$arrayproxies  = [];
			$firstnresults = 100;
			$rank = 0;
			$keyword    = str_replace(' ', '+', trim($keyword));
			$pages = ceil($firstnresults / 10);
			for($p=0; $p<$pages; $p++){		
				$start = $p * 10;
				$ua = [
                    0   => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201',
                    10  => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
                    20  => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1'
                ];
				$options = [
                        'http' => [
                            'method' => 'GET',
                            'header' => "Accept-language: en\r\n\id" .
                                "Cookie: PHP Google Keyword Position\r\n" . 
                                "User-Agent: " . $ua[$start]
                        ]
                    ];
		//$url        = sprintf('https://www.google.co.id/search?q=%s&start=%c&num=30', $keyword, $start);
		$url        = sprintf('https://www.google.co.id/search?ie=UTF-8&q=%s&start=%c&num=30', $keyword, $start);
		$context    = stream_context_create($options);
        $data  = @file_get_contents($url, false, $context);
                        $j = -1;
                        $i = 1;
                        while (($j = stripos($data, '<cite class="_Rm">', $j+1)) !== false ) {
                            $k           = stripos($data, '</cite>', $j);
                            $link        = strip_tags(substr($data, $j, $k-$j));
                            $rank        = $i++;
                            $results[]   = ['rank' => $rank, 'url' => $link];
							if(stripos($link, $domain) !== false){
								break(2);
							}
                        }
			}
            return $results;
        }
		private function _isCurlEnabled()
        {
          return function_exists('curl_version');
        }

        private function _curl($url)
        {
            try {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246');
                curl_setopt($ch, CURLOPT_AUTOREFERER, true);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSLVERSION, 'all');


                $content = curl_exec($ch);
                $errno   = curl_errno($ch);
                $error   = curl_error($ch);
                curl_close($ch);

                if (!$errno) {
                    return $content;
                } else {
                    return [
                        'errno' => $errno,
                        'errmsg'=> $error
                    ];
                }
            } catch (Exception $e) {
                return [
                    'errno'     => $e->getCode(),
                    'errmsg'    => $e->getMessage()
                ];
            }
        }
	}
}	