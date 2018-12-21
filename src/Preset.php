<?php

namespace PratyushPundir\LaravelBuefyPreset;

use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Arr;
use File;

class Preset extends LaravelPreset
{
    protected static $command;

    public static function install($command)
    {
        static::$command = $command;

        try {
            static::updatePackages();
            static::updateMix();
            static::updateScripts();
            static::updateStyles();
            static::updateBladeViews();

            $command->info('Scaffolding completed...');
            $command->info('You are ready. Build something awesome!');
        } catch (\Exception $exception) {
            $command->error('Whooops... Something went wrong!!!');
            return $exception;
        }
    }

    /**
     * Updates all NPM Packages.
     *
     * @param $defaultPackages
     * @return array
     */
    public static function updatePackageArray($defaultPackages)
    {
        $additionalPackages = [
            // "bulma" => "^0.7.2",
            "buefy" => "^0.7.1",
            "es6-promise" => "^4.2.5"
        ];

        $unwantedPackages = [
            "bootstrap",
            "lodash",
            "popper.js",
            "bulma"
        ];

        $wantedPackages = Arr::except($defaultPackages, $unwantedPackages);

        static::$command->info('NPM packages updated: packages.json');

        return array_merge($additionalPackages, $wantedPackages);
    }

    /**
     * Update Laravel Mix setup.
     */
    public static function updateMix()
    {
        copy(__DIR__ . '/stubs/js/webpack.mix.js', base_path('webpack.mix.js'));

        static::$command->info('Laravel Mix settings updated: webpack.mix.js');
    }

    /**
     * Update all Javascript scaffolding and set up use of Bulma.
     */
    public static function updateScripts()
    {
        copy(__DIR__ . '/stubs/js/bootstrap.js', resource_path('js/bootstrap.js'));
        copy(__DIR__ . '/stubs/js/app.js', resource_path('js/app.js'));

        if (! File::isDirectory(resource_path('js/components/shared'))) {
            File::makeDirectory(resource_path('js/components/shared'));
        } else {
            File::cleanDirectory(resource_path('js/components/shared'));
        }
        copy(__DIR__ . '/stubs/js/components/shared/LoginForm.vue', resource_path('js/components/shared/LoginForm.vue'));
        copy(__DIR__ . '/stubs/js/components/shared/RegisterForm.vue', resource_path('js/components/shared/RegisterForm.vue'));

        static::$command->info('JS Directory: resources/js');
    }

    /**
     * Update all SASS scaffolding and set up use of Bulma.
     */
    public static function updateStyles()
    {
        copy(__DIR__ . '/stubs/sass/_variables.scss', resource_path('sass/_variables.scss'));
        copy(__DIR__ . '/stubs/sass/app.scss', resource_path('sass/app.scss'));

        static::$command->info('SASS Directory: resources/sass');
    }

    /**
     * Add Bulma-based Blade Views.
     */
    public static function updateBladeViews()
    {
        if (! File::isDirectory(resource_path('views/buefy'))) {
            File::makeDirectory(resource_path('views/buefy'));
        } else {
            File::cleanDirectory(resource_path('views/buefy'));
        }

        File::makeDirectory(resource_path('views/buefy/layouts'));
        File::makeDirectory(resource_path('views/buefy/shared'));

        copy(__DIR__ . '/stubs/views/layouts/app.blade.php', resource_path('views/buefy/layouts/app.blade.php'));
        copy(__DIR__ . '/stubs/views/shared/bulma-nav.blade.php', resource_path('views/buefy/shared/bulma-nav.blade.php'));
        copy(__DIR__ . '/stubs/views/welcome.blade.php', resource_path('views/buefy/welcome.blade.php'));

        static::$command->info('Blade View Directory: resources/views/buefy');
    }
}
