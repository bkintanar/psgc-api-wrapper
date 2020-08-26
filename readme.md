# PHP Wrapper for Philippine Standard Geographic Code API

## Overview

This package is a simple php wrapper for the PSGC API found here: https://github.com/bkintanar/psgc-api.

## Installation

The recommended way to install PSGC API Wrapper is with Composer. Composer is a dependency management tool for PHP that allows you to declare the dependencies your project needs and installs them into your project.

```shell script
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

You can add PSGC API Wrapper as a dependency using Composer:

```shell script
composer require bkintanar/psgc-api-wrapper
```

Alternatively, you can specify PSGC API Wrapper as a dependency in your project's existing composer.json file:

```json
{
   "require": {
      "bkintanar/psgc-api-wrapper": "*"
   }
}
```

## Supported Methods

All endpoints provided by `https://github.com/bkintanar/psgc-api` are supported.

```
+----------+------------------------------------------+
| Method   | URI                                      |
+----------+------------------------------------------+
| GET|HEAD | api/barangays                            |
| GET|HEAD | api/barangays/{barangay}                 |
| GET|HEAD | api/cities                               |
| GET|HEAD | api/cities/{city}                        |
| GET|HEAD | api/districts                            |
| GET|HEAD | api/districts/{district}                 |
| GET|HEAD | api/municipalities                       |
| GET|HEAD | api/municipalities/{municipality}        |
| GET|HEAD | api/provinces                            |
| GET|HEAD | api/provinces/{province}                 |
| GET|HEAD | api/regions                              |
| GET|HEAD | api/regions/{region}                     |
| GET|HEAD | api/sub-municipalities                   |
| GET|HEAD | api/sub-municipalities/{subMunicipality} |
+----------+------------------------------------------+
```

### Using Laravel

#### Region

Region is the highest geographic level used by The Republic of the Philippines. The Philippines is divided into 17 regions as of 31 March 2020.

```php
<?php

use PSGC\Facades\Region;

Region::get();                                                        // Get a Collection of regions
Region::find('070000000');                                            // Get a specific region
Region::includes('provinces')->get();                                 // Get a Collection of regions and provinces
Region::includes('districts')->get();                                 // Get a Collection of regions and districts
Region::includes(['provinces', 'districts'])->get();                  // Get a Collection of regions and provinces and districts
```

#### District

> This geographic level is only used by the National Capital Region (NCR).

Unlike other administrative regions in the Philippines, Metro Manila is not composed of provinces. Instead, the region is divided into four geographic areas called "districts."

So instead of the usual geographic hierarchy of:

```
Region > Provinces > Cities, Municipalities > Barangays
```

The National Capital Region follows the geographic hierarchy of:

```
Region > Districts > Cities > Sub Municipalities > Barangays 
```

```php
<?php

use PSGC\Facades\District;

District::get();                                                      // Get a Collection of districts
District::find('133900000');                                          // Get a specific district
District::includes('cities')->get();                                  // Get a Collection of districts with its collection of cities
District::includes('cities')->find('133900000');                      // Get a specific district with its collection of cities
```

#### Province

One or more provinces belongs to one region. The Philippines is administratively divided into 81 provinces as of 31 March 2020. Any given province has one or more cities, and municipalities under it.

```php
<?php

use PSGC\Facades\Province;

Province::get();                                                      // Get a Collection of provinces
Province::find('072200000');                                          // Get a specific province
Province::includes('cities')->get();                                  // Get a Collection of provinces with its collection of cities
Province::includes('cities')->find('072200000');                      // Get a specific province with its collection of cities
Province::includes('municipalities')->get();                          // Get a Collection of provinces with its collection of municipalities
Province::includes('municipalities')->find('072200000');              // Get a specific province with its collection of municipalities
Province::includes(['cities', 'municipalities'])->get();              // Get a Collection of provinces with its collection of cities and municipalities
Province::includes(['cities', 'municipalities'])->find('072200000');  // Get a specific province with its collection of cities and municipalities
```


#### City

One or more cities belongs to one province or district. The Philippines is administratively divided into 146 cities as of 31 March 2020. Any given city has one or more barangays, sub-municipalities under it.

```php
<?php

use PSGC\Facades\City;

City::get();                                                          // Get a Collection of cities
City::find('072217000');                                              // Get a specific city
City::includes('barangays')->get();                                   // Get a Collection of cities with its collection of barangays. Not advised as this will retrieve all 42,046 barangays.
City::includes('barangays')->find('072217000');                       // Get a specific city with its collection of barangays
City::includes('subMunicipalities')->find('133900000');               // Get a specific city with its collection of sub-municipalities
```

#### Municipality

One or more municipalities belongs to one Province. The Philippines is administratively divided into 1,488 municipalities as of 31 March 2020. Any given municipality has one or more barangays under it.

```php
<?php

use PSGC\Facades\Municipality;

Municipality::get();                                                  // Get a Collection of municipalities
Municipality::find('072201000');                                      // Get a specific municipality
Municipality::includes('barangays')->get();                           // Get a Collection of municipalities with its collection of barangays.
Municipality::includes('barangays')->find('072201000');               // Get a specific municipality with its collection of barangays
```

#### Sub Municipality

> This geographic level is only used by the National Capital Region (NCR).

As far as NCR is concerned, cities have one or more sub-municipalities and each sub-municipality has one or more barangays.

```php
<?php

use PSGC\Facades\SubMunicipality;

SubMunicipality::get();                                               // Get a Collection of sub-municipalities
SubMunicipality::find('133901000');                                   // Get a specific sub-municipality
SubMunicipality::includes('barangays')->get();                        // Get a Collection of sub-municipalities with its collection of barangays.
SubMunicipality::includes('barangays')->find('133901000');            // Get a specific sub-municipality with its collection of barangays
```

#### Barangay

This is the lowest geographic level used by The Philippines. Any given barangay may be under to one city, one municipality, one sub-municipality. As barangay's the lowest geographic level, it doesn't have any geographic level under it, so no valid `includes`. 

```php
<?php

use PSGC\Facades\Barangay;

Barangay::get();                                                      // Get a Collection of barangays. advised as this will retrieve all 42,046 barangays.
Barangay::find('072201001');                                          // Get a specific sub-municipality
```

### Using Vanilla PHP

```php
<?php

require('vendor/autoload.php');

use PSGC\Region;

$region = new Region();

$region->get();                                                       // Get a Collection of regions
$region->find('070000000');                                           // Get a specific region
$region->includes('provinces')->get();                                // Get a Collection of regions and provinces
$region->includes('districts')->get();                                // Get a Collection of regions and districts
$region->includes(['provinces', 'districts'])->get();                 // Get a Collection of regions and provinces and districts
```

> Follow the pattern above to use with other geographic levels.
