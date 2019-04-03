<?php

namespace Mbyakow\HttpLogParser;

/**
 * Access log entry.
 */
class AccessLogEntry extends AbstractLogEntry
{
    /**
     * @var string
     */
    private $_url = null;

    /**
     * @var int
     */
    private $_traffic = 0;

    /**
     * @var string
     */
    private $_crawler = null;

    /**
     * @var int
     */
    private $_statusCode = null;

    /**
     * @return string|null
     */
    public function url(): ?string
    {
        return $this->_url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->_url = $url;
    }

    /**
     * @return int
     */
    public function traffic(): int
    {
        return $this->_traffic;
    }

    /**
     * @param int $traffic
     */
    public function setTraffic(int $traffic): void
    {
        $this->_traffic = $traffic;
    }

    /**
     * @return string|null
     */
    public function crawler(): ?string
    {
        return $this->_crawler;
    }

    /**
     * @param string $crawler
     */
    public function setCrawler(string $crawler): void
    {
        $this->_crawler = $crawler;
    }

    /**
     * @return int|null
     */
    public function statusCode(): ?int
    {
        return $this->_statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->_statusCode = $statusCode;
    }
}
