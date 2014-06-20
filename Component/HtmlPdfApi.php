<?php
/**
 * Created by PhpStorm.
 * User: Hex
 * Date: 16/06/14
 * Time: 13:08
 */

namespace Netgen\HtmlPdfApiBundle\Component;

use Guzzle\Http\Exception\ServerErrorResponseException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Batch\BatchBuilder;

class HtmlPdfApi {

    protected $client;

    public function __construct($host, $token)
    {
        $this->client = HtmlPdfApiClient::factory(array(
            'hostname' => $host,
            'token' => $token
        ));
    }

    // generates pdf from provided url
    public function generateFromURL($params)
    {
        if(empty($params['url']))
            throw new \Exception('Parameter \'url\' must be set' );

        if ((!empty($params['page_width']) && empty($params['page_height']))
            ||(empty($params['page_width']) && !empty($params['page_height'])))
        {
            throw new \Exception('Page width and page height must both be set or unset!');
        }
        $params = $this->validateBoolParameters($params);

        $command = $this->client->getCommand('GenerateFromURL', $params);
        //die(var_dump($params));

        //die(var_dump($command->toArray()));
        //var_dump($command->prepare()->getRawHeaders());die();

        //return $ret = $this->client->execute($command);
       try{
            $ret = $this->client->execute($command);
            return $ret;
        }catch(ClientErrorResponseException $exception){
            //die(var_dump($exception->getResponse()->getBody(true)));
           throw new \Exception($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode());
        }
    }

    // generates pdf from provided HTML string
    public function generateFromHTML($params)
    {
        if(empty($params['html']))
            throw new \Exception('Parameter \'html\' must be set' );

        if ((!empty($params['page_width']) && empty($params['page_height']))
        ||(empty($params['page_width']) && !empty($params['page_height'])))
        {
            throw new \Exception('Page width and page height must both be set or unset!');
        }
        $params = $this->validateBoolParameters($params);

        $command = $this->client->getCommand('GenerateFromHTML', $params);

        try{
            $ret = $this->client->execute($command);
            return $ret;
        }catch(ClientErrorResponseException $exception){
            //die(var_dump($exception->getResponse()->getBody(true)));
            throw new \Exception($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode());
        }
    }

    // returns available credits count
    public function getCredits()
    {
        $command = $this->client->getCommand('GetCredits');

        try{
            $ret = $this->client->execute($command);
            return $ret;
        }catch(ClientErrorResponseException $exception){
            //die(var_dump($exception->getResponse()->getBody(true)));
            throw new \Exception($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode());
        }
    }

    // uploads new asset to the HTMLPDFAPI server
    public function uploadAsset($filePath)
    {
        $command = $this->client->getCommand('UploadAsset', array(
            'file' => '@'.$filePath
        ));

        try{
            $ret = $this->client->execute($command);
            return $ret;
        }catch(ClientErrorResponseException $exception){
            //die(var_dump($exception->getResponse()->getBody(true)));
            throw new \Exception($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode());
        }
    }

    // download asset by id
    public function getAsset($id)
    {
        $command = $this->client->getCommand('GetAsset', array(
            'id' => $id
        ));

        try{
            $ret = $this->client->execute($command);
            return $ret;
        }catch(ClientErrorResponseException $exception){
            //die(var_dump($exception->getResponse()->getBody(true)));
            throw new \Exception($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode());
        }
    }

    // delete asset by id
    public function deleteAsset($id)
    {
        $command = $this->client->getCommand('DeleteAsset', array(
            'id' => $id
        ));

        try{
            $ret = $this->client->execute($command);
            return $ret;
        }catch(ClientErrorResponseException $exception){
            //die(var_dump($exception->getResponse()->getBody(true)));
            throw new \Exception($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode());
        }
    }

    // get list of assets (id, name, mime, size)
    public function getAssetList()
    {
        $command = $this->client->getCommand('GetAssetList');

        try{
            $ret = $this->client->execute($command);
            return $ret;
        }catch(ClientErrorResponseException $exception){
            //die(var_dump($exception->getResponse()->getBody(true)));
            throw new \Exception($exception->getResponse()->getBody(true), $exception->getResponse()->getStatusCode());
        }
    }

    // get asset ID by name
    public function getAssetID($name)
    {
        $list = $this->getAssetList();

        foreach ($list as $asset)
        {
            if ($asset['name'] == $name)
            {
                return $asset['id'];
            }

            throw new \Exception('No asset found by name');
        }
    }


    // guzzle converts bool(false) to null
    // this function validates bool parameters to int (0,1)
    private function validateBoolParameters($params)
    {
        if (isset($params['lowquality']) && $params['lowquality']===false)
        {
            $params['lowquality'] = (int) $params['lowquality'];
        }
        if (isset($params['images']) && $params['images']===false)
        {
            $params['images'] = (int) $params['images'];
        }
        if (isset($params['outline']) && $params['outline']===false)
        {
            $params['outline'] = (int) $params['outline'];
        }
        if (isset($params['javascript']) && $params['javascript']===false)
        {
            $params['javascript'] = (int) $params['javascript'];
        }
        if (isset($params['internal_links']) && $params['internal_links']===false)
        {
            $params['internal_links'] = (int) $params['internal_links'];
        }
        if (isset($params['external_links']) && $params['external_links']===false)
        {
            $params['external_links'] = (int) $params['external_links'];
        }
        if (isset($params['use_print_media']) && $params['use_print_media']===false)
        {
            $params['use_print_media'] = (int) $params['use_print_media'];
        }
        if (isset($params['background']) && $params['background']===false)
        {
            $params['background'] = (int) $params['background'];
        }
        return $params;
    }
} 