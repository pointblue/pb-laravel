# Point Blue Laravel

Shared Larvel code for Point Blue applications

Install with command `composer require pointblue/laravel`

## Views

To install a view, use the command `php artisan pb:view {viewname}` 
where `{viewname}` is the name of the view that will be copied to the 
`resources/views` path of your laravel app. Use this list of available 
views:  

  - `footer` - Standard Point Blue footer
  - `navbar` - Standard Point Blue navigation bar
  - `loading` - loading bar, requires uib-progressbar
  
The view will be installed to the directory
`resources/views/partials/universal`

#### Environment Variables

The views will need these environment variables to be set in the `.env` file:

- APP_URL
- PB_APP_NAME
- PB_APP_IMAGE_URL
