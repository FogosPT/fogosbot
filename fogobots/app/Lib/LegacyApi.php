<?php
/**
 * Created by PhpStorm.
 * User: tomahock
 * Date: 03/05/2018
 * Time: 19:08
 */
namespace App\Lib;

use GuzzleHttp;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class LegacyApi
{
    private static $url = 'https://api-lb.fogos.pt';

    private static function getClient()
    {
        $client = new GuzzleHttp\Client();

        return $client;
    }

    public static function getStatus()
    {
        $client = self::getClient();

        $url = self::$url . '/v1/status';

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getActive()
    {
        $client = self::getClient();

        $url = self::$url . '/v1/active';

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getAerial()
    {
        $client = self::getClient();

        $url = self::$url . '/v1/aerial';

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getStats()
    {
        $client = self::getClient();

        $url = self::$url . '/v1/stats';

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getDangerLocation($location)
    {
        $client = self::getClient();

        $url = self::$url . '/v1/risk?concelho=' . $location;

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getListLocation($location)
    {
        $client = self::getClient();

        $url = self::$url . '/v1/list?concelho=' . $location;

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getFire($id)
    {
        $client = self::getClient();

        $url = self::$url . '/fires?id=' . $id;

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getRiskByFire($id)
    {
        $client = self::getClient();
        $url = self::$url . '/fires/danger?id=' . $id;

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }

    public static function getStatusByFire($id)
    {
        $client = self::getClient();
        $url = self::$url . '/fires/status?id=' . $id;

        try {
            $response = $client->request('GET', $url);

        } catch (ClientException $e) {
            return ['error' => $e->getMessage()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }

        $body = $response->getBody();
        $result = json_decode($body->getContents(), true);
        return $result;
    }
}