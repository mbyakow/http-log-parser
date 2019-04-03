<?php

namespace Mbyakow\HttpLogParser;

/**
 * Basic log parser class.
 */
abstract class AbstractParser
{
    /**
     * @var string
     */
    protected $_regex;

    /**
     * @param string $line
     *
     * @return AbstractLogEntry
     */
    abstract public function parse(string $line);
}
