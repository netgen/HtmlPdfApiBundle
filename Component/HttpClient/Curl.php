<?php

namespace Netgen\HtmlPdfApiBundle\Component\HttpClient;

use Netgen\HtmlPdfApiBundle\Component\HttpClientInterface;

class Curl implements HttpClientInterface {

    protected $host;
    protected $token;

    public function __construct($host, $token)
    {
        $this->host = $host;
        $this->token = $token;
    }

    private function initiatePost($url, $params)
    {
        $ch = curl_init($this->host.'/'.$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authentication: Token ". $this->token));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        return $ch;
    }

    private function initiateGet($url, $params)
    {;
        if (!empty($params))
        {
            $parameter=implode(array_values($params));
            $url .= '/'.$parameter;
        }
        $ch = curl_init($this->host.'/'.$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authentication: Token ". $this->token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return $ch;
    }

    private function initiateDelete($url, $params)
    {

        if (!empty($params))
        {
            $parameter=implode(array_values($params));
            $url .= '/'.$parameter;
        }
        $ch = curl_init($this->host.'/'.$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authentication: Token ". $this->token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        return $ch;
    }


    public function sendRequest($url, $params, $method)
    {
        if($method=='POST')
        {
            $ch = $this->initiatePost($url, $params);
        }
        if($method=='GET')
        {
            $ch = $this->initiateGet($url, $params);
        }
        if($method=='DELETE')
        {
            $ch = $this->initiateDelete($url, $params);
        }

        $ret = curl_exec($ch);
        curl_close($ch);

        return $ret;
    }

} 