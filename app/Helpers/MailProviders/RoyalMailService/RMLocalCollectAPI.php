<?php
/**
 *  Royal Mail Local Collect REST API
 *
 *  Integrated for DepotDash
 *
 * @author Gevorg Hovsepyan <hovsepyan.gev1@gmail.com>
 *
 * @category RoyalMailProviders
 * @package RoyalMailService
 *
 * @todo api calls are not working correctly, RM support is needed. 
 */

namespace App\Helpers\MailProviders\RoyalMailService;

class RMLocalCollectAPI {


    public $verify = false;

    /**
     * @var string $baseUrl
     */
    protected $endpoint = 'https://api.royalmail.net/localCollectOffices';

    protected $credentials = [
        'ClientID' => 'X-IBM-Client-Id',
        'ClientSecret' => 'X-IBM-Client-Secret'
    ];

    /** @var  object $client */
    protected $client;


    public function __construct($params = [])
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->endpoint,
            'verify' => $this->verify,
            'headers' => [
                'X-IBM-Client-Id' => env('PROVIDER_RM_CLIENT_ID'),
                'X-IBM-Client-Secret' => env('PROVIDER_RM_SECRET_ID')
            ],
        ]);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $params
     * @return mixed
     */
    public function request($method, $uri, $params = [])
    {
        $response = $this->client->request($method, $uri, $params);

        return json_decode((string)$response->getBody(),false, 512, JSON_BIGINT_AS_STRING);
    }

    public function get()
    {
        $params = [
            'postcode' => '',
            'estDeliveryDate' => '',
            'radius' => ''
        ];

        return $this->request('GET', '', $params);
    }

    public function geoSearch()
    {
        $params = [
            'latitude' => '',
            'longitude' => '',
            'estDeliveryDate' => '',
            'radius' => ''
        ];

        return $this->request('GET', '/geosearch', $params);
    }

    public function bookingReference($ref)
    {
        return $this->request('PUT', '/' . $ref);
    }
}