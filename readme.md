# Re-direct Importer

Imports items from a CSV file into Dolphiq's table structure. Assumes the CSV
has the following structure:

| Source URL Title | Destination URL Title |
|------------------|-----------------------|
| /foo             | /bar                  |
| /phi             | /pho                  |

## Installation

1. Install dependencies: `composer install`.
2. Set variables in the `.env` file. Use `.env.sample` as a template if needed.

## Usage

``` shell
php index.php
```
