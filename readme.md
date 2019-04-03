# HTTP log parser

Simple parser for HTTP logs. At the moment supports only access log files.

## Installation

1. Clone or download project files to your desktop.
1. Execute `composer install` command.

## Usage

To parse any HTTP access log file just execute in your console: `php parser.php <file>`

In `data` directory you'll find sample data sets for testing purposes. For example, you can run `php parser.php ./data/access_log`. Result:

```
{
    "views": 16,
    "urls": 5,
    "traffic": 187990,
    "crawlers": {
        "Google": 2,
        "Bing": 0,
        "Baidu": 0,
        "Yandex": 0
    },
    "statusCodes": {
        "200": 14,
        "301": 2
    }
}
```