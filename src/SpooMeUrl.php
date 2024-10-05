<?php
/**
 * Project shorten-url.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2018-12-27
 * Time: 16:55
 */

namespace nguyenanhung\ShortenUrl;

/**
 * Class TinyURL
 *
 * @package   nguyenanhung\ShortenUrl
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class SpooMeUrl implements ShortenUrlInterface
{
    use ShortenUrlTrait, RequestTrait;

    const ENDPOINT = 'https://spoo.me';

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
        $this->shortUrl = $this->spooMeRequest($this->longUrl);
        return $this;
    }

    protected function spooMeRequest($longUrl = '')
    {
        if (empty($longUrl)) {
            return '';
        }
        $longUrl = (string)$longUrl;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::ENDPOINT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'url=' . urlencode($longUrl),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if (!$err) {
            $res = json_decode($response);
            if (!empty($res->short_url)) {
                return $res->short_url;
            }
        }
        return null;
    }
}
