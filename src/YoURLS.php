<?php

namespace nguyenanhung\ShortenUrl;

defined('YOURLS_API') or define('YOURLS_API', '');
defined('YOURLS_API_TOKEN') or define('YOURLS_API_TOKEN', '');

/**
 * Class YoURLS
 *
 * Create short url with API of YOURLS
 *
 * @package   nguyenanhung\ShortenUrl
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class YoURLS implements ShortenUrlInterface
{
    use ShortenUrlTrait, RequestTrait;

    /**
     * Function shortenUrl
     *
     * @return $this
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 17:06
     *
     */
    public function shortenUrl()
    {
        if (empty($this->longUrl)) {
            $this->shortUrl = '';
        }
        $this->shortUrl = $this->requestYoUrls($this->longUrl);
        return $this;
    }

    protected function requestYoUrls($longUrl = '')
    {
        if (empty($longUrl)) {
            return '';
        }
        if (empty(YOURLS_API) || empty(YOURLS_API_TOKEN)) {
            return '';
        }
        $timestamp = time();
        $signature = md5($timestamp . YOURLS_API_TOKEN);
        $params = [
            'url' => $longUrl,
            'format' => 'json',
            'action' => 'shorturl',
            'timestamp' => $timestamp,
            'signature' => $signature
        ];
        $request = $this->sendRequest(YOURLS_API, $params);
        $res = json_decode($request, false);
        if (isset($res->errorCode) && $res->errorCode === 403) {
            return 'Error: ' . $res->message;
        }
        if (isset($res->statusCode) && $res->statusCode === 200) {
            return $res->shorturl;
        }
        return '';
    }
}
