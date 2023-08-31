<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'mnre' => [
            'driver' => 'session',
            'provider' => 'mnre_users',
        ],

        'state-implementing-agency' => [
            'driver' => 'session',
            'provider' => 'state_implementing_agency_users',
        ],

        'localbody' => [
            'driver' => 'session',
            'provider' => 'localbody_users',
        ],

        'installer' => [
            'driver' => 'session',
            'provider' => 'installers',
        ],

        'inspector' => [
            'driver' => 'session',
            'provider' => 'inspectors',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
        'beneficiary' => [
            'driver' => 'session',
            'provider' => 'beneficiary',
        ],
        'seci' => [
            'driver' => 'session',
            'provider' => 'seci',
        ],
        'gecdeveloper' => [
            'driver' => 'session',
            'provider' => 'gecdeveloper',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'mnre_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Mnre::class,
        ],

        'state_implementing_agency_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\StateImplementingAgencyUser::class,
        ],

        'localbody_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\LocalbodyUser::class,
        ],

        'installers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Installer::class,
        ],

        'inspectors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Inspector::class,
        ],
         'beneficiary' => [
            'driver' => 'eloquent',
            'model' => App\Models\Beneficiary::class,
        ],
        'seci' => [
            'driver' => 'eloquent',
            'model' => App\Models\Seci::class,
        ],
        'gecdeveloper' => [
            'driver' => 'eloquent',
            'model' => App\Models\Gecd::class,
        ],
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'mnre_users' => [
            'provider' => 'mnre_users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'state_implementing_agency_users' => [
            'provider' => 'state_implementing_agency_users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'localbody_users' => [
            'provider' => 'localbody_users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'installers' => [
            'provider' => 'installers',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'inspectors' => [
            'provider' => 'inspectors',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];