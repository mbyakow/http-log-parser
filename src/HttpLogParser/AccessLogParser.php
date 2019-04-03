<?php

namespace Mbyakow\HttpLogParser;

/**
 * Parser for regular HTTP access log files.
 */
class AccessLogParser extends AbstractParser
{
    /**
     * @var string
     */
    protected $_regex = '/^(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+)(\s\-\s0)? (\S+) "([^"]*)" "([^"]*)"(.*?)$/';

    /**
     * @var string[]
     */
    protected $_crawlerSignatures = [
        'Google' => 'google',
        'Bing'   => 'bing',
        'Baidu'  => 'baidu',
        'Yandex' => 'yandex',
    ];

    /**
     * @param string $line
     *
     * @return AccessLogEntry|null
     */
    public function parse(string $line): ?AccessLogEntry
    {
        $result = new AccessLogEntry();

        preg_match($this->_regex, $line, $matches);
        if (count($matches) === 0) {
            return null;
        }

        $result->setUrl($matches[8]);
        $result->setStatusCode((int)$matches[10]);

        if ($result->statusCode() === 200) {
            $result->setTraffic((int)$matches[12]);
        }

        foreach ($this->_crawlerSignatures as $key => $crawlerSignature) {
            if (!strstr(strtolower($matches[14]), $crawlerSignature)) {
                continue;
            }

            $result->setCrawler($key);
        }

        return $result;
    }
}
