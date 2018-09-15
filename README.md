# PARA UNA MEJOR PRESENTACIÓN DE LA DOCUMENTACIÓN ENTREN A https://codwelt.com/blog/posts/paquete-codviews 

# FOR A BETTER PRESENTATION OF THE DOCUMENTATION ENTER TO https://codwelt.com/blog/posts/paquete-codviews

# codviews
Codviews is a package developed in php for laravel, this is intended to help us very quickly in knowing the impact that our website is having on the world.

It has api designed to be coupled with graphics or any resource that we want for the visualization of what happens on the web.

Some of the data that codview offers us is the amount of people that visit our page, the ip that makes the visit, the geographical location and other data that will help us to know the impact that is taking geographically.

## Information about installation and use



## Installation

To be able to use the package we have to make a composer requires:

composer require codwelt / codviews
After installing the package we will make a

composer dump-autoload
With this we make sure that the package has been installed correctly, following this we will publish the necessary files for the package.

php artisan vendor: publish
With this we will have published in the project the views, seeders, configuration and middleware of the package. next step will be to execute the migrations of the package.

php artisan migrate
Now that we have made the successful migrations, we will execute the seed of the initial configuration

php artisan db: seed --class = Configcodviewseed
Now we have successfully installed the package ¡¡Congratulations !!!.

## Package configuration

since the package is successfully installed now we must configure it, there is no need to worry if we execute the previous step of the seeder, since this leaves a default configuration to the package. In the same way we have to make the middleware configuration for the routes and the activation method of the visitor registry.

### Configuring middleware for routes

There are routes to which a middleware can be placed so that only logged users or the criteria they propose are executed and not open to the public.

Therefore, if we go to the folder config / codviews.php we will find something similar to this:

return [
    'Middleware' => [
        'web' => [
            'admin' => [
                'Web',
                'auth'
            ],
        ],
    ],
];


in the section located in the center called admin we can place an array of middlewares that will be executed on the packet routes.

Register activator visit

In order to obtain the record of the visit, we must execute a record trigger, which will obtain all the necessary data from the visitor and store it in the database for its visualization by the administration.

You can activate that trigger in 2 ways, by means of a Middleware to the routes that we want to be monitored or by means of ajax calling a route.

#### Middleware Method

By means of the middleware method we will use a middleware that was published when we used the vendor: publish command, this was published in the middleware folder of the App \ Http \ Middleware \ codviews project.

to use this middleware we must register it in the kernel in the following way:

we go to the App \ Http folder and find a file called Kernel.php
We will paste the route of the middleware in the import section, as it appears in the following image.
use App \ Http \ Middleware \ codviews \ Tracker;


Once the tracker is imported we will now proceed to register it for the use in the routes, we will go to the bottom of the file to the variable called $ routeMiddleware, we will add our middleware in the following way.

'Tracker' => \ App \ Http \ Middleware \ codviews \ Tracker :: class,
 


Once this is done, what remains is to use the middleware in our routes.

#### AJAX method

This method is much easier than the previous one since I just need to specify JQUERY, for the activation by this method we must paste this javascript code that is an ajax call to the route that triggers the tracking, this code will be pasted in some file js or script of the views that we want to monitor.

#code
   $ .ajax ({
        url: "/ codviews / crawl / api",
        data: "",
        method: "get",
        success: function (result) {
        },
        error: function (result) {
            console.log (result);
        },
        beforeSend: function () {
        }
    });         
        
When this is done, the call to the tracker will return the following data for its use

TotalVisits; Total visits registered so far.
continent: Continent from where the visit is being made.
Country: Country from where the visit is being made.
region: Region from where the visit is taking place.
created_at: Date of the visit.

# ROUTES
 

To obtain the data we can use the following routes that will return the data of the visits to the page

This route will return the page for the visualization of all the records of visits url ('/ codviews / home /') or route ('CodviewInicio')

This route will show us in detail the visit of an ip in specific url (/ codviews / details / {id}) or route ('CodviewDetalle')

This url brings us the configuration page of the package that url ('/ codviews / configuration /') or route ('codviewsconfigcontroller');

## ROUTES API
This url will not bring the visits made to the page to the month url ('/ codviews / visits / graphics / month / month')

This url will not bring visits made to the page every day of the month url ('/ codviews / visits / graphics / month / days')

If we call this url we can obtain geographic data from the history of visits made to the url page ('/ codviews / visits / graphic / demographic / {option}') this route has a series of options that we can combine as the data that we can obtain and the format in which we want to obtain them:

### How to obtain

We add to the last part of the route the variable get called relacion

Options for the relationship variable:

numeric
code
Options for demographic data:

countries
continente
ciudad
region

relationship with the format we want like this:
https://codwelt.com/codviews/visitas/graficas/demograficas/paises?relacion=numerico
when making this call I brought the following in json format

[
   {
      "Codigo":"US",
      "Pais":"United States",
      "CantidadRelativa":282,
      "CantidadAbsoluta":11735
   },
   {
      "Codigo":"CO",
      "Pais":"Colombia",
      "CantidadRelativa":79,
      "CantidadAbsoluta":4400
   },
   {
      "Codigo":"DE",
      "Pais":"Germany",
      "CantidadRelativa":10,
      "CantidadAbsoluta":51
   },
   {
      "Codigo":"CN",
      "Pais":"China",
      "CantidadRelativa":22,
      "CantidadAbsoluta":26
   },
   {
      "Codigo":"RU",
      "Pais":"Russia",
      "CantidadRelativa":16,
      "CantidadAbsoluta":19
   },
   {
      "Codigo":"JP",
      "Pais":"Japan",
      "CantidadRelativa":2,
      "CantidadAbsoluta":13
   },
   {
      "Codigo":"AU",
      "Pais":"Australia",
      "CantidadRelativa":2,
      "CantidadAbsoluta":13
   },
   {
      "Codigo":"CA",
      "Pais":"Canada",
      "CantidadRelativa":6,
      "CantidadAbsoluta":12
   },
   {
      "Codigo":"BR",
      "Pais":"Brazil",
      "CantidadRelativa":1,
      "CantidadAbsoluta":12
   },
   {
      "Codigo":"TH",
      "Pais":"Thailand",
      "CantidadRelativa":11,
      "CantidadAbsoluta":11
   },
   {
      "Codigo":"NL",
      "Pais":"Netherlands",
      "CantidadRelativa":7,
      "CantidadAbsoluta":10
   },
   {
      "Codigo":"FR",
      "Pais":"France",
      "CantidadRelativa":9,
      "CantidadAbsoluta":9
   },
   {
      "Codigo":"IN",
      "Pais":"India",
      "CantidadRelativa":2,
      "CantidadAbsoluta":7
   },
   {
      "Codigo":"IE",
      "Pais":"Ireland",
      "CantidadRelativa":5,
      "CantidadAbsoluta":5
   },
   {
      "Codigo":"GB",
      "Pais":"United Kingdom",
      "CantidadRelativa":4,
      "CantidadAbsoluta":5
   },
   {
      "Codigo":null,
      "Pais":null,
      "CantidadRelativa":3,
      "CantidadAbsoluta":5
   },
   {
      "Codigo":"SE",
      "Pais":"Sweden",
      "CantidadRelativa":1,
      "CantidadAbsoluta":4
   },
   {
      "Codigo":"KR",
      "Pais":"Republic of Korea",
      "CantidadRelativa":2,
      "CantidadAbsoluta":4
   },
   {
      "Codigo":"CL",
      "Pais":"Chile",
      "CantidadRelativa":2,
      "CantidadAbsoluta":3
   },
   {
      "Codigo":"IT",
      "Pais":"Italy",
      "CantidadRelativa":1,
      "CantidadAbsoluta":2
   },
   {
      "Codigo":"ES",
      "Pais":"Spain",
      "CantidadRelativa":2,
      "CantidadAbsoluta":2
   },
   {
      "Codigo":"IR",
      "Pais":"Iran",
      "CantidadRelativa":1,
      "CantidadAbsoluta":2
   },
   {
      "Codigo":"ID",
      "Pais":"Indonesia",
      "CantidadRelativa":2,
      "CantidadAbsoluta":2
   },
   {
      "Codigo":"MX",
      "Pais":"Mexico",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   {
      "Codigo":"UA",
      "Pais":"Ukraine",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   {
      "Codigo":"DZ",
      "Pais":"Algeria",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   {
      "Codigo":"TR",
      "Pais":"Turkey",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   {
      "Codigo":"GT",
      "Pais":"Guatemala",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   {
      "Codigo":"LT",
      "Pais":"Republic of Lithuania",
      "CantidadRelativa":1,
      "CantidadAbsoluta":0
   }
]

Where the relative amount is the number of visits made by different people and the absolute amount is the number of visits made by all people.

Now we will do the same code relation query
https://codwelt.com/codviews/visitas/graficas/demograficas/paises?relacion=codigo
{
   "US":{
      "Pais":"United States",
      "CantidadRelativa":282,
      "CantidadAbsoluta":11735
   },
   "CO":{
      "Pais":"Colombia",
      "CantidadRelativa":79,
      "CantidadAbsoluta":4400
   },
   "DE":{
      "Pais":"Germany",
      "CantidadRelativa":10,
      "CantidadAbsoluta":51
   },
   "CN":{
      "Pais":"China",
      "CantidadRelativa":22,
      "CantidadAbsoluta":26
   },
   "RU":{
      "Pais":"Russia",
      "CantidadRelativa":16,
      "CantidadAbsoluta":19
   },
   "AU":{
      "Pais":"Australia",
      "CantidadRelativa":2,
      "CantidadAbsoluta":13
   },
   "JP":{
      "Pais":"Japan",
      "CantidadRelativa":2,
      "CantidadAbsoluta":13
   },
   "CA":{
      "Pais":"Canada",
      "CantidadRelativa":6,
      "CantidadAbsoluta":12
   },
   "BR":{
      "Pais":"Brazil",
      "CantidadRelativa":1,
      "CantidadAbsoluta":12
   },
   "TH":{
      "Pais":"Thailand",
      "CantidadRelativa":11,
      "CantidadAbsoluta":11
   },
   "NL":{
      "Pais":"Netherlands",
      "CantidadRelativa":7,
      "CantidadAbsoluta":10
   },
   "FR":{
      "Pais":"France",
      "CantidadRelativa":9,
      "CantidadAbsoluta":9
   },
   "IN":{
      "Pais":"India",
      "CantidadRelativa":2,
      "CantidadAbsoluta":7
   },
   "GB":{
      "Pais":"United Kingdom",
      "CantidadRelativa":4,
      "CantidadAbsoluta":5
   },
   "":{
      "Pais":null,
      "CantidadRelativa":3,
      "CantidadAbsoluta":5
   },
   "IE":{
      "Pais":"Ireland",
      "CantidadRelativa":5,
      "CantidadAbsoluta":5
   },
   "SE":{
      "Pais":"Sweden",
      "CantidadRelativa":1,
      "CantidadAbsoluta":4
   },
   "KR":{
      "Pais":"Republic of Korea",
      "CantidadRelativa":2,
      "CantidadAbsoluta":4
   },
   "CL":{
      "Pais":"Chile",
      "CantidadRelativa":2,
      "CantidadAbsoluta":3
   },
   "ES":{
      "Pais":"Spain",
      "CantidadRelativa":2,
      "CantidadAbsoluta":2
   },
   "IR":{
      "Pais":"Iran",
      "CantidadRelativa":1,
      "CantidadAbsoluta":2
   },
   "ID":{
      "Pais":"Indonesia",
      "CantidadRelativa":2,
      "CantidadAbsoluta":2
   },
   "IT":{
      "Pais":"Italy",
      "CantidadRelativa":1,
      "CantidadAbsoluta":2
   },
   "DZ":{
      "Pais":"Algeria",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   "TR":{
      "Pais":"Turkey",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   "GT":{
      "Pais":"Guatemala",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   "MX":{
      "Pais":"Mexico",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   "UA":{
      "Pais":"Ukraine",
      "CantidadRelativa":1,
      "CantidadAbsoluta":1
   },
   "LT":{
      "Pais":"Republic of Lithuania",
      "CantidadRelativa":1,
      "CantidadAbsoluta":0
   }
}
