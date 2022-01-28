### **EVE Seeder**

This package is based of Eve SeAT's new seeder classes which can be found here:

https://github.com/eveseat/eveapi/tree/5.0.x/src/database/seeders

All credits to these seeders go to warlof: https://github.com/warlof

Current Seeders Available are:

- StaStations
- InvTypes (Items and types)
- InvGroups ( Item Groups )
- InvCategories ( Item Categories )
- MapSolarSystemJumps ( Stargate connections )
- MapDenormalize ( Solar Systems, Constellations, Regions, Planets and Moons )

### **Usage**

###### **1\. include the package:**

`composer require laravelevetools/eve-seeder`

###### **2\. Publish the config**

`php artisan vendor:publish --tag=sde-config`

###### **3.\ Setup which SDE you want to seed.**

Uncomment the SDE classes you want to seed.
example:
```
// config/eve-sde.php

'seeders' => [
    \LaravelEveTools\EveSeeder\Database\Seeders\Sde\InvTypesSeeder::class,
    \LaravelEveTools\EveSeeder\Database\Seeders\Sde\InvGroupsSeeder::class,
    \LaravelEveTools\EveSeeder\Database\Seeders\Sde\InvCategoriesSeeder::class,
    // \LaravelEveTools\EveSeeder\Database\Seeders\Sde\StaStationsSeeder::class,
    \LaravelEveTools\EveSeeder\Database\Seeders\Sde\MapDenormalizeSeeder::class,
    // \LaravelEveTools\EveSeeder\Database\Seeders\Sde\MapSolarSystemJumps::class,
]
```

###### **4.\ Run the seed artisan command**

`php artisan eve:sde:update`
