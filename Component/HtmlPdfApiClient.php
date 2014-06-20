<?php
/**
 * Created by PhpStorm.
 * User: Hex
 * Date: 16/06/14
 * Time: 11:59
 */

namespace Netgen\HtmlPdfApiBundle\Component;

use Guzzle\Service\Client;
use Guzzle\Common\Collection;
use Guzzle\Service\Description\ServiceDescription;

class HtmlPdfApiClient extends Client {

    public static function factory($config = array())
    {
        //fallback value
        $default = array(
            //'hostname' => '{host}',
            //'host' => 'https://htmlpdfapi.com//api//v1//'
        );

        $required = array('hostname', 'token');
        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('hostname'));
        $client->setDescription(ServiceDescription::factory(__DIR__.DIRECTORY_SEPARATOR.'service.json'));

        $client->setDefaultOption("headers", array(
            'Authentication' => 'Token' . " " . $config->get('token')
        ));

        return $client;
    }

} 