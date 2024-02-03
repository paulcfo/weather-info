<?php

namespace Drupal\weather_info\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\ClientInterface;

class WeatherInfoController extends ControllerBase {

  protected $httpClient;
  protected $configFactory;

  public function __construct(ClientInterface $http_client, ConfigFactoryInterface $config_factory) {
    $this->httpClient = $http_client;
    $this->configFactory = $config_factory;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('http_client'),
      $container->get('config.factory')
    );
  }

  public function display() {

    //\Drupal::messenger()->addMessage('Weather Info module is working.');

    $config = $this->configFactory->get('weather_info.settings');
    $api_key = $config->get('api_key');
    $city = $config->get('city');

    // API call to OpenWeatherMap
    $city = urlencode($city);
    $api_key = urlencode($api_key);
    $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=imperial&appid=$api_key";
    $response = $this->httpClient->request('GET', $url);


    $data = json_decode($response->getBody());  // Convert JSON to PHP object
    //\Drupal::logger('weather_info')->notice('<pre><code>' . print_r($data, TRUE) . '</code></pre>');

    return [
      '#theme' => 'weather_info_display',
      '#weather' => $data,
      '#cache' => [
        'max-age' => 3600,
      ],
    ];
  }
}

