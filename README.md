# CobaltBlue #

# Table of Contents #

1. [CobaltBlue](#cobaltblue)
2. [Installation](#installation)
2. [Usage](#usage)

# Installation #

Installing CobaltBlue should be pretty simple:
1. Download via Composer:

        composer require salyam/cobaltblue
    After CobaltBlue is installed, it should be present in the config/app.php file, it can be checked via searching   

        Salyam\CobaltBlue\PermissionServiceProvider::class,
2. Include the following line in app/User.php:

        use \Salyam\CobaltBlue\Traits\CobaltBlueUserTrait;
3. Run the following command to publish views from CobaltBlue:

        php artisan vendor:publish
    After everything is published, views from CobaltBlue can be changed under views/salyam/cobaltblue folder.

    That's it, CobaltBlue is now installed under Laravel, and every function of it can be used now.

# Usage #
- Creating a role

        use \Salyam\CobaltBlue\Models\Role;

        $fields = [
                'name' => 'admin',
                'label' => 'Administrator'
        ];
        Role::create($fields);

- Creating a permission

        use \Salyam\CobaltBlue\Models\Permission;

        $fields = [
                'name' => 'articles.view',
                'label' => 'View artiacles'
        ];
        Permission::create($fields);

- Granting a role to the current user

        Auth::user()->GrantRole(1);
        Auth::user()->GrantRole('admin');
- Revoking a role from the current user

        Auth::user()->RevokeRole(1);
        Auth::user()->RevokeRole('admin');

- Granting a permission to the current user

        Auth::user()->GrantPermission(3);
        Auth::user()->GrantPermission('articles.edit');

- Revoking a permission from the current user

        Auth::user()->RevokePermission(3);
        Auth::user()->RevokePermission('articles.edit');
