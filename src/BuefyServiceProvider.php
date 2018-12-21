<?php

namespace PratyushPundir\LaravelBuefyPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class BuefyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the Buefy preset macro
        PresetCommand::macro('buefy', function ($command) {
            Preset::install($command);
        });
    }
}
