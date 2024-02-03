## BRIEF

The expectation is that the weather information is available on a page `/weather-info`. 
This module fetches and displays weather information from an external API (like OpenWeatherMap) on that webpage.

The user would need to enter the `city` and `API KEY` as configuration elements into a form here: `admin/config/services/weather-info`.

## HINT

1. **Module Structure Creation**
   - Create a new module folder in `/modules/custom/` named `weather_info`.
   - Within this folder, create the following files:
     - `weather_info.info.yml` (module metadata)
     - `weather_info.module` (main module file, theme registration)
     - `src/Controller/WeatherInfoController.php` (handles data fetching and display logic)
     - `src/Form/WeatherInfoConfigForm.php` (configuration form for API key and city)
     - `weather_info.routing.yml` (defines routes)
     - `templates/weather-info.html.twig` (Twig template for displaying weather data)
     - `weather_info.links.menu.yml` (allows the config form to appear on the `/admin/config` page)

2. **Implement API Integration in Controller (`WeatherInfoController.php`)**
   - Create a controller class to handle API requests to the weather service.
   - Use Drupal's Http Client service for API calls i.e. `GuzzleHttp\ClientInterface`
   - Process the API response and prepare it for display.

3. **Create Configuration Form (`WeatherInfoConfigForm.php`)**
   - Develop a form for the site admin to enter the API key and city.
   - Implement form validation and submission to save configurations.

4. **Routing and Menu Link Setup (`weather_info.routing.yml`)**
   - Define a route for displaying weather data and for the configuration form.
   - Create a `weather_info.links.menu.yml` for a menu link to the configuration form.

5. **Create Twig Template (`weather-info.html.twig`)**
   - Design a simple Twig template for displaying the fetched weather data on the website.
