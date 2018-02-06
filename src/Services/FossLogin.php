<?php

/**
 * @file
 */

namespace Drupal\foss\Services;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;

class FossLogin implements LoginService {

  private $header = [];
  private $username;
  private $password;
  private $isSessionAlive = FALSE;
  private $baseUrl;

  public function __construct(ConfigFactory $config_factory) {
    $config = $config_factory->getEditable('foss.settings');
    $this->username = $config->get('foss.username');
    $this->password = $config->get('foss.password');
    $this->baseUrl = $config->get('foss.link');
  }

  public function login($url){
    $client = new Client();
    $response = $client->request('GET', $this->baseUrl.$url,['auth' =>[$this->username,$this->password]]);

    return json_decode($response->getBody()->getContents(), true);
  }

  private function setHeaders($username, $password){
    $header = array();
    $header[] = 'Content-length: 0';
    $header[] = 'Content-type: application/json';

    return $header;
  }
  private function isSessionAlive(){

    return $this->isSessionAlive;
  }
}