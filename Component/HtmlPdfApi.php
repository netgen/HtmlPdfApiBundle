<?php

namespace Netgen\HtmlPdfApiBundle\Component;

class HtmlPdfApi {

    protected $client;
    protected $validator;

    public function __construct(HttpClientInterface $http_client, ValidatorInterface $validator)
    {
        $this->client = $http_client;
        $this->validator = $validator;
    }

    // generates pdf from provided url
    public function generateFromURL($params)
    {
        if(empty($params['url']))
            throw new \Exception('Parameter \'url\' must be set' );

        $params = $this->validator->validate($params);

        try {
            return $this->client->sendRequest('pdf', $params, 'POST');
        } catch (\Exception $ex) {
            throw $ex;
        }

    }

    // generates pdf from provided HTML string
    public function generateFromHTML($params)
    {
        if(empty($params['html']))
            throw new \Exception('Parameter \'html\' must be set' );

        $params = $this->validator->validate($params);

        try {
            return $this->client->sendRequest('pdf', $params, 'POST');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    // returns available credits count
    public function getCredits()
    {
        $params = array();

        try {
            return $this->client->sendRequest('credits', $params, 'GET');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    // uploads new asset to the HTMLPDFAPI server
    public function uploadAsset($filePath)
    {
        $params = array( 'file' => '@'.$filePath );
        $params = $this->validator->validate($params);

        try {
            return $this->client->sendRequest('assets', $params, 'POST');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    // download asset by id
    public function getAsset($id)
    {
        $params = array( 'id' => $id );
        $params = $this->validator->validate($params);

        try {
            return $this->client->sendRequest('assets', $params, 'GET');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    // delete asset by id
    public function deleteAsset($id)
    {
        $params = array( 'id' => $id );
        $params = $this->validator->validate($params);

        try {
            return $this->client->sendRequest('assets', $params, 'DELETE');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    // get list of assets (id, name, mime, size)
    public function getAssetList()
    {
        $params = array();

        try {
            return $this->client->sendRequest('assets', $params, 'GET');
        } catch (\Exception $ex) {
            throw $ex;
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
        }
        throw new \Exception('No asset found by name');
    }
} 