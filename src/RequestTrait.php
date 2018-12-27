<?php
/**
 * Project shorten-url.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2018-12-27
 * Time: 17:00
 */

namespace nguyenanhung\ShortenUrl;

/**
 * Trait RequestTrait
 *
 * @package   nguyenanhung\ShortenUrl
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
trait RequestTrait
{
    /**
     * Function sendRequest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 17:05
     *
     * @param string $url
     * @param string $data
     * @param string $method
     *
     * @return bool|string
     */
    public function sendRequest($url = '', $data = '', $method = 'GET')
    {
        $endpoint = (!empty($data) && (is_array($data) || is_object($data))) ? $url . '?' . http_build_query($data) : $url;
        $method   = strtoupper($method);
        $curl     = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_POSTFIELDS     => "",
            CURLOPT_HTTPHEADER     => array(),
        ));
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return NULL;
        } else {
            return $response;
        }
    }
}
