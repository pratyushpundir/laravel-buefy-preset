### Buefy Frontend Preset For Laravel

This preset provides UI components that marry [Bulma](https://bulma.io/) and [VueJS](https://vuejs.org/) together in the form of [Buefy](https://buefy.github.io/documentation/snackbar) for any new [Laravel](https://laravel.com/) site / web-app. In Buefy's own words, it provides:
 > Lightweight UI components for Vue.js based on Bulma.

<p align="center">
  <img width="1080" src="https://i.ibb.co/JCr7Xrb/Screen-Flow.gif" alt="Animation" border="0">
</p>
 
### What it does
 - Removes ````bootstrap```` in favor of ````bulma```` and provides VueJS components to easily use all (and more...) of the Bulma components.
 - Other NPM packages removed: ```lodash```, ````jquery````, ````popper.js````.
 - Adds a Bulma based Blade layout: ````resources/views/buefy/layouts/app.blade.php````.
 - Adds a Bulma based Blade view: ````resources/views/buefy/welcome.blade.php````.
 - Adds a Bulma based "Navbar" Blade component: ````resources/views/buefy/shared/bulma-nav.blade.php````.
 - Adds Vue and Bulma based "Navbar" Blade component: ````resources/views/buefy/shared/bulma-nav.blade.php````.
 - Adds Vue and Bulma based "Login" and "Register" forms components: ````resources/js/components/shared/LoginForm.vue````,    ````resources/js/components/shared/RegisterForm.vue````.
 - Adds versioning / cache-busting of CSS and JS assets for production environments in your ````webpack.mix.js````.


### WARNING!!
 The preset provided Blade views are namespaced their own directory, ```/bulma``` so nothing should go wrong on that front, but, for a non-fresh project, it ***will 100%*** squash any custom JS, SASS, Mix code you may have written). ___You have been warned!___
 

 ### Getting Started
 - ````cd```` into your ***fresh*** Laravel project.
 - Run ````composer require pratyushpundir/laravel-buefy-preset````.
 - Then run `````php artisan preset buefy`````. This will scaffold everything you need to replace Bootstrap with Bulma and set up your JS, SASS and Blade Views.
 - Install and compile your assets with ````yarn && yarn watch```` or ````npm install && npm run watch```` (but ```yarn``` is so much better!!!).
 - Visit ````routes/web.php```` and change the following piece of code:
 
 ````php
 Route::get('/', function () {
     // Change this...
     return view('welcome');
 });
 ````
 
 to
 
 ````php
 Route::get('/', function () {
     // ...to this!
     return view('buefy.welcome');
 });
 ````
That's it!. Run ````php artisan serve```` and visit ```http://localhost:8000``` for a brand new, Bulma+VueJS-based, Welcome page! 

### Extras
#### Asset versioning / cache-busting in Production
You need to ensure 2 things happen for this to work:
 1. SASS and JS assets need to be compiled using the the ````production```` settings. To do this, run ````yarn production```` or ````yarn prod````. You can use NPM too of course. But we talked about this! 
 2. Your Laravel app needs to be in ````production```` environment. Do this in your ````.env```` file.

#### Enable the Version Number Badge in ````bulma-nav.blade.php````
 1. Add ````'version' => env('APP_VERSION', '1.0.0'),```` to your ```config/app.php``` file.
 2. Add ````APP_VERSION=YOUR_VERSION_NUMBER```` to your ````.env```` file. Replace "YOUR_VERSION_NUMBER" with whatever you need.

#### Configure the environment indicator
This preset also adds an environment indicator to help you distinguish between various app environments your Laravel app can be in (local, dev, staging, production, etc.). It shows up as a thin colored bar at the very top of the page. The color of the bar indicates the app environment.

This works by adding a class-name equal to a hyphenated form of the environment name you set in your ````.env```` file. You can then configure the colors you want your indicator to have in ````resources/sass/app.scss````. Hunt down the following piece of code and change it as needed:
````scss
// Configure environment-wise colors you need per environment
#env-indicator.local {
    background-color: $primary;
}

#env-indicator.dev {
    background-color: $primary-invert;
}

// Hide the environment indicator on your choice of environments
#env-indicator.production,
#env-indicator.staging {
    display: none !important;
}
````
 

### Author
Pratyush Pundir   
Email: pratyushpundir@icloud.com
