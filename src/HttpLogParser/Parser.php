<?php

namespace Mbyakow\HttpLogParser;

/**
 * Class Parser
 * @package App
 */
class Parser
{
    /**
     * @var resource
     */
    private $_file = null;

    /**
     * @param string $file
     *
     * @return Parser
     */
    public function open(string $file): Parser
    {
        if ($this->file() !== null) {
            return $this;
        }

        $file = fopen($file, 'r');

        if (!$file) {
            throw new \Error("Can't open specified file.");
        }

        $this->_setFile($file);

        return $this;
    }

    /**
     * @return ParseResult
     */
    public function parse(): ParseResult
    {
        $result          = new ParseResult();
        $accessLogParser = new AccessLogParser();
        $file            = $this->file();

        while (!feof($file)) {
            $line        = fgets($file);
            $parseResult = $accessLogParser->parse($line);

            if (!$parseResult) {
                continue;
            }

            $result->viewsAdd();
            $result->urlsAdd($parseResult->url());
            $result->trafficAdd($parseResult->traffic());
            $result->crawlersAdd($parseResult->crawler());
            $result->statusCodesAdd($parseResult->statusCode());
        }

        $this->_closeFile();

        return $result;
    }

    /**
     * @return resource|null
     */
    private function file()
    {
        return $this->_file;
    }

    /**
     * @param resource $file
     */
    private function _setFile($file): void
    {
        $this->_file = $file;
    }

    private function _closeFile(): void
    {
        fclose($this->file());
        $this->_setFile(null);
    }
}
