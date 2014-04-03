<?php

/*
This script is licensed under Apache 2.0. View the license here:
http://www.apache.org/licenses/LICENSE-2.0.html
Copyright Reserved to g0g0l
Contact @ Skype : noc2spam

*/


class googleScraper {
	// add google domains for all country
    public static $domains = array('en' => 'google.com');

    static function scrape($keyword, $urlToSearch, $country = 'en', $resultsToFetch = 100) {
        $keyword = str_replace(" ", "+", $keyword);
        try {
            $domain = self::$domains[$country];
            $url = 'https://www.' . $domain . '/search?num=' . $resultsToFetch . '&safe=off&site=&source=hp&q=' . $keyword;
        } catch (Exception $e) {
            echo "Exception thrown:" . $e->getMessage();
            die();
        }
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_URL, $url);
        $html = curl_exec($ch);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

// grab all the on the page
        $xpath = new DOMXPath($dom);
        $links = $xpath->query('//h3[@class="r"]//a');

        $length = $links->length;
        $all_links = array();
        //echo $urlToSearch;
        //echo '<br/>';
        for ($i = 0; $i < $length; $i++) {

            $element = $links->item($i);
            // echo $urlToSearch = preg_quote($urlToSearch);
            $resultUrl = $xpath->evaluate('@href', $element)->item(0)->value;
            // echo '<br/>';
            if (!empty($urlToSearch)) {
                foreach ($urlToSearch as $u2s) {
                    if (preg_match("#{$u2s}#i", $resultUrl)) {
                        return $i + 1;
                    }
                }
            }
        }
        return 0;
    }

}
