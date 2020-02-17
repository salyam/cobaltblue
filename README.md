# CobaltBlue #

# Table of Contents #

 1. [CobaltBlue](#cobaltblue)
 2. [Installation](#installation)
 2. [Usage](#usage)

# Installation #

Installing CobaltBlue should be pretty simple:
1. Download via Composer: 
        ```
        composer require salyam/cobaltblue
        ```
    After CobaltBlue is installed, it should be present in the config/app.php file, it can be checked via searching   
        ```
        Salyam\CobaltBlue\PermissionServiceProvider::class,
        ```
2. Include the following line in app/User.php:
        ```
        use \Salyam\CobaltBlue\Traits\CobaltBlueUserTrait;
        ```
3. Run the following command to publish views from CobaltBlue:
        ```
        php artisan vendor:publish
        ```
    After everything is published, views from CobaltBlue can be changed under views/salyam/cobaltblue folder.

  That's it, CobaltBlue is now installed under Laravel, and every function of it can be used now.

# Usage #