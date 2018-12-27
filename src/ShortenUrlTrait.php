<?php
/**
 * Project shorten-url.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2018-12-27
 * Time: 16:58
 */

namespace nguyenanhung\ShortenUrl;

/**
 * Trait ShortenUrlTrait
 *
 * @package   nguyenanhung\ShortenUrl
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 *
 * @property mixed longUrl
 * @property mixed shortUrl
 */
trait ShortenUrlTrait
{
    /**
     * Function setLongUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 16:57
     *
     * @param string $longUrl
     *
     * @return $this
     */
    public function setLongUrl($longUrl = '')
    {
        $this->longUrl = $longUrl;

        return $this;
    }

    /**
     * Function getLongUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 16:58
     *
     * @return string
     */
    public function getLongUrl()
    {
        return $this->longUrl;
    }

    /**
     * Function getShortUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 16:58
     *
     * @return string
     */
    public function getShortUrl()
    {
        return $this->shortUrl;
    }
}
