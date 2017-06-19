<?php

/**
 * @file
 */

namespace Drupal\dhis\Services;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;

class DhisLogin implements LoginService {

  private $header = array();
  private $username;
  private $password;
  private $isSessionAlive = FALSE;
  private $baseUrl;

  public function __construct(ConfigFactory $config_factory) {
    $config = $config_factory->getEditable('dhis.settings');
    $this->username = $config->get('dhis.username');
    $this->password = $config->get('dhis.password');
    $this->baseUrl = $config->get('dhis.link');
  }


  public function login($url){
    drupal_set_message($this->baseUrl.$url);
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