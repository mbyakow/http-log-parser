<?php

namespace Mbyakow\HttpLogParser;

/**
 * Parsing result class.
 */
class ParseResult
{
    /**
     * @var int
     */
    private $_views = 0;

    /**
     * @var string[]
     */
    private $_urls = [];

    /**
     * @var int
     */
    private $_traffic = 0;

    /**
     * @var int[]
     */
    private $_crawlers = [
        'Google' => 0,
        'Bing'   => 0,
        'Baidu'  => 0,
        'Yandex' => 0,
    ];

    /**
     * @var int[]
     */
    private $_statusCodes = [];

    /**
     * @param int $options
     *
     * @return false|string
     */
    public function json(int $options = null): string
    {
        return json_encode($this->data(), $options);
    }

    /**
     * @param int $delta
     */
    public function viewsAdd(int $delta = 1): void
    {
        $this->setViews($this->views() + (int)$delta);
    }

    /**
     * @param string $url
     */
    public function urlsAdd(string $url): void
    {
        if (in_array($url, $this->urls())) {
            return;
        }

        $this->addUrl($url);
    }

    /**
     * @param int $traffic
     */
    public function trafficAdd(int $traffic): void
    {
        $this->setTraffic($this->traffic() + $traffic);
    }

    /**
     * @param string $crawler
     */
    public function crawlersAdd(string $crawler = null): void
    {
        if (!$crawler) {
            return;
        }

        $crawlers = $this->crawlers();
        $crawlers[$crawler] += 1;
        $this->setCrawlers($crawlers);
    }

    /**
     * @param int $statusCode
     */
    public function statusCodesAdd(int $statusCode = null): void
    {
        if (!$statusCode) {
            return;
        }

        $statusCodes = $this->statusCodes();

        if (! array_key_exists($statusCode, $statusCodes)) {
            $statusCodes[$statusCode] = 1;
        } else {
            $statusCodes[$statusCode] += 1;
        }

        $this->setStatusCodes($statusCodes);
    }

    /**
     * @return int
     */
    public function views(): int
    {
        return $this->_views;
    }

    /**
     * @param int $views
     */
    public function setViews(int $views): void
    {
        $this->_views = $views;
    }

    /**
     * @return array
     */
    public function urls(): array
    {
        return $this->_urls;
    }

    /**
     * @param array $urls
     */
    public function setUrls(array $urls): void
    {
        $this->_urls = $urls;
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
     * @return array
     */
    public function crawlers(): array
    {
        return $this->_crawlers;
    }

    /**
     * @param array $crawlers
     */
    public function setCrawlers(array $crawlers): void
    {
        $this->_crawlers = $crawlers;
    }

    /**
     * @return array
     */
    public function statusCodes(): array
    {
        return $this->_statusCodes;
    }

    /**
     * @param array $statusCodes
     */
    public function setStatusCodes(array $statusCodes): void
    {
        $this->_statusCodes = $statusCodes;
    }

    /**
     * @return array
     */
    private function data(): array
    {
        return [
            'views'       => $this->views(),
            'urls'        => count($this->urls()),
            'traffic'     => $this->traffic(),
            'crawlers'    => $this->crawlers(),
            'statusCodes' => $this->statusCodes(),
        ];
    }

    /**
     * @param string $url
     */
    private function addUrl(string $url): void
    {
        $urls   = $this->urls();
        $urls[] = $url;

        $this->setUrls($urls);
    }
}
