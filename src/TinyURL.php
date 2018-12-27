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
class TinyURL implements ShortenUrlInterface
{
    use ShortenUrlTrait, RequestTrait;
    const ENDPOINT = 'https://tinyurl.com/api-create.php?url=';

    /**
     * Function shortenUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 17:06
     *
     * @return $this
     */
    public function shortenUrl()
    {
        if (empty($this->longUrl)) {
            $this->shortUrl = '';
        }
        $url = self::ENDPOINT . $this->longUrl;
        $this->shortUrl = $this->sendRequest($url);
        return $this;
    }
}
