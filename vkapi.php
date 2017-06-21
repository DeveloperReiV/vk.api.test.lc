<?php

class vkapi
{
    private $app_id;
    private $secret_key;
    private $api_version;
    private $api_url = 'https://api.vk.com';
    private $access_token;

    function __construct($app_id = null, $secret_key = null, $api_version = '3.0', $access_token = null)
    {
        $this->app_id = $app_id;
        $this->secret_key = $secret_key;
        $this->api_version = $api_version;
        $this->access_token = $access_token;
    }

    public function api_query($method, $params = false)
    {
        if(!$params) $params = array();

        $params['api_id'] = $this->app_id;
        $params['v'] = $this->api_version;
        $params['sig'] = md5($this->secret_key);
        $params['format'] = 'json';
        $params['access_token'] = $this->access_token;

        ksort($params);
        $params = http_build_query($params);

        $query = $this->api_url . '/method/' . $method . '?' . $params;

        $result = json_decode(file_get_contents($query));

        return $result;
    }

    /*public function params(array $params)
    {
        if(is_array($params))
        {
            $result = [];
            foreach($params as $key => $value)
            {
                $result[$key] = urlencode($value);
            }
            $result = http_build_query($params);

            return $result;
        }
        return false;
    } */

}