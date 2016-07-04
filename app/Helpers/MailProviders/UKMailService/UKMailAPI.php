<?php

/**
 * UK Mail Web Service API
 *
 * Integrated for DepotDash
 *
 * @author Gevorg Hovsepyan <hovsepyan.gev1@gmail.com>
 *
 * @category UKMailProviders
 * @package UKMailService
 */

namespace App\Helpers\MailProviders\UKMailService;


class UKMailAPI
{
    /**
     * @var array $Endpoints UKM TEST and LIVE endpoints
     */
    protected $Endpoints = [
        'ukm' => [
            'test' => 'https://qa-api.ukmail.com',
            'live' => 'https://api.ukmail.com'
        ],

        'tracking' => [
            'test' => 'http://apollo.internet-delivery.com',
            'live' => 'http://webapp-cl.internet-delivery.com'
        ]
    ];

    /**
     * @var array $URIs API all URIs
     */
    protected $URIs = [

        'Login' => '/Services/UKMAuthenticationServices/UKMAuthenticationService.svc?wsdl',
        'Logout' => '/Services/UKMAuthenticationServices/UKMAuthenticationService.svc?wsdl',

        'BookCollection' => '/Services/UKMCollectionServices/UKMCollectionService.svc?wsdl',

        'AddDomesticConsignment' => '/Services/UKMConsignmentServices/UKMConsignmentService.svc?wsdl',
        'AddInternationalConsignment' => '/Services/UKMConsignmentServices/UKMConsignmentService.svc?wsdl',
        'AddPacketConsignment' => '/Services/UKMConsignmentServices/UKMConsignmentService.svc?wsdl',
        'AddReturnToSender' => '/Services/UKMConsignmentServices/UKMConsignmentService.svc?wsdl',
        'AddSendToThirdParty' => '/Services/UKMConsignmentServices/UKMConsignmentService.svc?wsdl',
        'CancelConsignment' => '/Services/UKMConsignmentServices/UKMConsignmentService.svc?wsdl',
        'CancelReturn' => '/Services/UKMConsignmentServices/UKMConsignmentService.svc?wsdl',

        'GetPostcodes' => '/Services/UKMReferenceDataServices/UKMReferenceDataService.svc?wsdl',
        'GetCountries' => '/Services/UKMReferenceDataServices/UKMReferenceDataService.svc?wsdl',

        'ConsignmentTrackingSearchV1' => '/ThirdPartyIntegration/ThirdPartyIntegrationService.asmx?wsdl',
        'ConsignmentTrackingGetStatusV1' => '/ThirdPartyIntegration/ThirdPartyIntegrationService.asmx?wsdl',
        'ConsignmentTrackingGetConsignmentDetailsV3' => '/ThirdPartyIntegration/ThirdPartyIntegrationService.asmx?wsdl',
        'ConsignmentTrackingGetFullDetailsV3' => '/ThirdPartyIntegration/ThirdPartyIntegrationService.asmx?wsdl'
    ];

    /**
     * @var object $Account Service Account
     */
    protected $Account;

    /**
     * @var array $credentials User credentials
     */
    protected $credentials;

    /**
     * @var bool $isTest Test mode
     */
    protected $isTest = true; // Default false


    public function __construct($params = [])
    {
        $this->credentials = [
            'Username' => env('PROVIDER_UKM_USERNAME'),
            'Password' => env('PROVIDER_UKM_PASSWORD')
        ];

        $auth = $this->authorize();

        if ($auth->Result == 'Successful') {
            $this->Account = $auth->Accounts->AccountWebModel;
            $this->AccessToken = $auth->AuthenticationToken;
        } else {
            $this->Errors = $auth->Errors;
        }
    }

    /**
     * API authorization
     *
     * @return object Response result
     */
    protected function authorize()
    {
        $params = [
            'loginWebRequest' => $this->credentials
        ];

        $response = $this->SoapClient('Login', $params);

        return $response->LoginResult;
    }

    /**
     * Send request via SoapClient to get data
     *
     * @param string $method URI alias
     * @param array $params
     * @param string $endpoint
     * @return \SoapClient
     */
    protected function SoapClient($method, $params = [], $endpoint = 'ukm')
    {
        $endpoint = $this->isTest ? $this->Endpoints[$endpoint]['test'] : $this->Endpoints[$endpoint]['live'];

        $params = $this->prepareParams($params);

        return (new \SoapClient($endpoint . $this->URIs[$method]))->$method($params);
    }

    /**
     * Request to API to get data
     *
     * @param string $method
     * @param array $params Request parameters
     * @param string $endpoint
     * @return object
     */
    protected function Request($method, $params = [], $endpoint = 'ukm')
    {
        $RequestParams = [];

        if ($endpoint == 'ukm') {

            $RequestParams['request'] = [
                'Username' => $this->credentials['Username'],
                'AuthenticationToken' => $this->AccessToken,
            ];

            $RequestParams['request'] = array_merge($RequestParams['request'], $params);
        }

        if ($endpoint == 'tracking') {

            $RequestParams = [
                'Username' => $this->credentials['Username'],
                'Password' => $this->credentials['Password'],
                'Token' => $this->AccessToken,
            ];

            $RequestParams = array_merge($RequestParams, $params);
        }

        return $this->SoapClient($method, $RequestParams, $endpoint);
    }

    /**
     * Convert request array to object
     *
     * @param array $params
     * @return object
     */
    protected function prepareParams($params = [])
    {
        return json_decode(json_encode($params));
    }

    /**
     * Book Collection
     *
     * * Request parameters *
     * AccountNumber            -Y- UK Mail account number.
     * ClosedForLunch           -Y- Is the address to be collected from closed for lunch true or false.
     * EarliestTime             -Y- Earliest Date and Time the parcels will be ready for collection. Example 2013-06-11T11:48:00.000
     * LatestTime               -Y- Latest Date and Time the parcels will be ready for collection.
     * RequestedCollectionDate  -Y- Date on which the parcels should be collected.
     * SpecialInstructions      -N- Any special instructions for the UK Mail driver who will be collecting the parcels.
     *
     * @param array $params
     * @return object Response Collection object
     */
    public function BookCollection($params = [])
    {
        $Request = [
            'AccountNumber' => $this->Account->AccountNumber,
            'ClosedForLunch' => false,
            'EarliestTime' => '',
            'LatestTime' => '',
            'RequestedCollectionDate' => '',
            'SpecialInstructions' => ''
        ];

        $Request = array_merge($Request, $params);

        return $this->Request('BookCollection', $Request);
    }

    /**
     * Add Domestic Consignment
     *
     * @return object Response consignment object
     */
    public function AddDomesticConsignment()
    {
        $date = new \DateTime();

        $params = [
            'EarliestTime' => $date->format('Y-m-d\TH:i:s'),
            'LatestTime' => $date->format('Y-m-d\TH:i:s'),
            'RequestedCollectionDate' => $date->format('Y-m-d\TH:i:s')
        ];
        $collection = $this->BookCollection($params);

        $Request = [
            'AccountNumber' => $this->Account->AccountNumber,
            'Address' => [
                'Address1' => 'Westfield Head House, The Arches, Maryport, Cumbria',
                'CountryCode' => 'GBR',
                'County' => '',
                'PostalTown' => 'Maryport',
                'Postcode' => 'CA15 8HF'
            ],
            'AlternativeRef' => 'Ref 2',
            'BusinessName' => 'Business Name',
            'CollectionJobNumber' => $collection->BookCollectionResult->CollectionJobNumber,
            'ConfirmationOfDelivery' => false,
            'ContactName' => 'Contact',
            'CustomersRef' => 'Ref 1',
            'Email' => 'hovsepyan.gev1@gmail.com',
            'Items' => 1,
            'ServiceKey' => 1,
            'SpecialInstructions1' => 'Spec 1',
            'SpecialInstructions2' => 'Spec 2',
            'Telephone' => '01213351000',
            'Weight' => 1,
            'BookIn' => false,
            'CODAmount' => 1.00,
            'ConfirmationEmail' => 'hovsepyan.gev1@gmail.com',
            'ConfirmationTelephone' => 01213351000,
            'ExchangeOnDelivery' => false,
            'ExtendedCover' => 0,
            'LongLength' => false,
            'PreDeliveryNotification' => 'NonRequired',
            'SecureLocation1' => 'secure 1',
            'SecureLocation2' => 'secure 2',
            'SignatureOptional' => false
        ];

        return $this->Request('AddDomesticConsignment', $Request);
    }

    /**
     * Add International Consignment
     *
     * @return object Response consignment object
     */
    public function AddInternationalConsignment()
    {
        $date = new \DateTime();

        $params = [
            'EarliestTime' => $date->format('Y-m-d\TH:i:s'),
            'LatestTime' => $date->format('Y-m-d\TH:i:s'),
            'RequestedCollectionDate' => $date->format('Y-m-d\TH:i:s')
        ];

        $collection = $this->BookCollection($params);

        $Request = [
            'AccountNumber' => $this->Account->AccountNumber,
            'Address' => [
                'Address1' => '150 Lee Ave,Brooklyn, NY', // Y
                'Address2' => '', // N
                'Address3' => '', // N
                'County' => '', // N
                'CountryCode' => 'USA', // Y
                'PostalTown' => 'NY', // Y
                'Postcode' => '11211' // Y
            ],
            'CollectionJobNumber' => $collection->BookCollectionResult->CollectionJobNumber,
            'ContactName' => 'Gevorg Hovsepyan', // Y
            'BusinessName' => 'Gevorg Hovsepyan business', // N
            'CustomersRef' => '', // N
            'AlternativeRef' => '', // N
            'ConfirmationOfDelivery' => false,
            'Email' => 'hovsepyan.gev1@gmail.com',
            'Items' => 1,
            'ServiceKey' => 1,
            'SpecialInstructions1' => 'Spec 1',
            'SpecialInstructions2' => 'Spec 2',
            'Telephone' => '01213351000',
            'Weight' => 1,
            'CurrencyCode' => 'USD',
            'DocumentsOnly' => false,
            'ExtendedCoverRequired' => false,
            'GoodsDescription1' => 'Goods1',
            'GoodsDescription2' => 'Goods2',
            'GoodsDescription3' => 'Goods3',
            'InFreeCirculationEU' => true,
            'InvoiceType' => 'Commercial',
            'NoDangerousGoods' => true,
            'Length' => 10,
            'Width' => 20,
            'Height' => 30,
            'Value' => 10.45,
        ];

        return $this->Request('AddInternationalConsignment', $Request);
    }

    /**
     *
     *
     *
     */
    public function AddPacketConsignment()
    {
        $date = new \DateTime();

        $params = [
            'EarliestTime' => $date->format('Y-m-d\TH:i:s'),
            'LatestTime' => $date->format('Y-m-d\TH:i:s'),
            'RequestedCollectionDate' => $date->format('Y-m-d\TH:i:s')
        ];

        $collection = $this->BookCollection($params);

        $Request = [
            'AccountNumber' => $this->Account->AccountNumber,
            'Address' => [
                'Address1' => 'Westfield Head House, The Arches, Maryport, Cumbria', // Y
                'Address2' => '', // N
                'Address3' => '', // N
                'County' => '', // N
                'PostalTown' => 'Maryport', // Y
                'Postcode' => 'CA15 8HF' // Y
            ],
            'CollectionJobNumber' => $collection->BookCollectionResult->CollectionJobNumber,
            'ContactName' => 'Gevorg Hovsepyan', // Y
            'BusinessName' => 'Gevorg Hovsepyan business', // N
            'CustomersRef' => '', // N
            'AlternativeRef' => '', // N
            'WeightInGrams' => 0,
            'PacketLength' => 0,
            'PacketWidth' => 0,
            'PacketHeight' => 0,
            'DeliveryMessage1' => '',
            'DeliveryMessage2' => ''
        ];

        return $this->Request('AddPacketConsignment', $Request);
    }

    /**
     * Add return to sender
     *
     * @return object
     */
    public function AddReturnToSender()
    {
        $Request = [
            'request' => [
                'AccountNumber' => $this->Account->AccountNumber,
                'CollectionContactName' => '', // Y
                'CollectionBusinessName' => '', // N
                'BookIn' => false, // Y
                'CollectionAddress' => [
                    'Address1' => '', // Y
                    'Address2' => '', // N
                    'Address3' => '', // N
                    'CountryCode' => '', // Y
                    'County' => '', // N
                    'PostalTown' => '', // Y
                    'Postcode' => '' // Y
                ],
                'CollectionCustomersRef' => '', // N
                'CollectionDate' => '2013-06-11T11:48:00.000', // Y
                'CollectionEmail' => '', // N
                'CollectionLatestPickup' => '>2013-06-11T17:00:00.000',  // Y
                'CollectionOpenLunchtime' => false, // Y
                'CollectionSpecialInstructions1' => '', // N
                'CollectionSpecialInstructions2' => '', // N
                'CollectionTelephone' => '', // Y
                'CollectionTimeReady' => '', // Y
                'DeliverySpecialInstructions1' => '', // N
                'DeliverySpecialInstructions2' => '', // N
                'DescriptionOfGoods1' => '', // N
                'DescriptionOfGoods2' => '', // N
                'ServiceKey' => 123456, // Y
            ]
        ];

        return $this->Request('AddReturnToSender', $Request);
    }

    /**
     *
     *
     *
     */
    public function AddSendToThirdParty()
    {
        $Request = [
            'AccountNumber' => $this->Account->AccountNumber,
            'BookIn' => false, // Y
            'CollectionAddress' => [
                'Address1' => '', // Y
                'Address2' => '', // N
                'Address3' => '', // N
                'CountryCode' => '', // Y
                'County' => '', // N
                'PostalTown' => '', // Y
                'Postcode' => '' // Y
            ],
            'CollectionContactName' => '', // Y
            'CollectionBusinessName' => '', // N
            'CollectionCustomersRef' => '', // N
            'CollectionDate' => '2013-06-11T11:48:00.000', // Y
            'CollectionEmail' => '', // N
            'CollectionLatestPickup' => '>2013-06-11T17:00:00.000',  // Y
            'CollectionOpenLunchtime' => false, // Y
            'CollectionSpecialInstructions1' => '', // N
            'CollectionSpecialInstructions2' => '', // N
            'CollectionTelephone' => '', // Y
            'CollectionTimeReady' => '', // Y
            'DeliverySpecialInstructions1' => '', // N
            'DeliverySpecialInstructions2' => '', // N
            'DescriptionOfGoods1' => '', // N
            'DescriptionOfGoods2' => '', // N
            'ServiceKey' => 123456, // Y
            'DeliveryAddress' => [
                'Address1' => '', // Y
                'Address2' => '', // N
                'Address3' => '', // N
                'CountryCode' => '', // Y
                'County' => '', // N
                'PostalTown' => '', // Y
                'Postcode' => '' // Y
            ],
            'DeliveryBusinessName' => '',
            'DeliveryContactName' => '',
            'DeliveryEmail' => '',
            'DeliveryTelephone' => '',
        ];

        return $this->Request('AddSendToThirdParty', $Request);

    }

    /**
     * Cancel Consignment
     *
     * * Request Parameters
     *
     * ConsignmentNumber - required
     *
     * @param string|number $number
     * @return object
     */
    public function CancelConsignment($number)
    {
        return $this->Request('CancelConsignment', ['ConsignmentNumber' => $number]);
    }

    /**
     * Cancel Return
     *
     * * Request Parameters
     *
     * ConsignmentNumber - required
     *
     * @param string|number $number
     * @return object
     */
    public function CancelReturn($number)
    {
        return $this->Request('CancelReturn', ['ConsignmentNumber' => $number]);
    }

    /**
     * Get Postcodes
     *
     * * Request Parameters
     *
     * LastUpdateDate - required - format Y-m-d\TH:i:s
     *
     * @param string $date Postcodes ast updated date
     * @return object
     */
    public function GetPostcodes($date)
    {
        return $this->Request('GetPostcodes', ['LastUpdateDate' => $date]);
    }

    /**
     * Get countries
     *
     * @return object
     */
    public function GetCountries()
    {
        return $this->Request('GetCountries');
    }

    /** Tracking  */

    /**
     * Get Consignment Tracking
     *
     * * Request Parameters *
     * ConsignmentNumber            - N - UK Mail consignment number to search for.
     * IsPartialConsignmentNumber   - Y - Search by partial consignment number (true) or full consignment number (false)
     * CustomerReference            - N - Customer reference (or Alternative Reference) to search for.
     * IsPartialCustomerReference   - Y - Search by partial customer reference (true) or full reference number (false).
     * DeliveryPostCode             - N - Delivery postcode to search for
     * MailingID                    - N - For mail type consignments (e.g. letters)
     * MaxResults                   - Y - Maximum number of search results to return (0 to 100).
     *
     * @param $params
     * @return object
     */
    public function ConsignmentTrackingSearchV1($params)
    {
        $Request = [
            'ConsignmentNumber' => '',
            'IsPartialConsignmentNumber' => false,
            'CustomerReference' => '',
            'IsPartialCustomerReference' => '',
            'DeliveryPostCode' => '',
            'MailingID' => '',
            'MaxResults' => '',
        ];

        $Request = array_merge($Request, $params);

        return $this->Request('ConsignmentTrackingSearchV1', $Request, 'tracking');
    }

    /**
     *  Get consignment tracking status
     *
     * @param $params
     * @return object
     */
    public function ConsignmentTrackingGetStatusV1($params)
    {
        $Request = [
            'ConsignmentNumber' => '',
            'ConsignmentKey' => '',
        ];

        $Request = array_merge($Request, $params);

        return $this->Request('ConsignmentTrackingGetStatusV1', $Request, 'tracking');
    }

    /**
     *
     * Get Details of consignment tracking
     *
     * @param $params
     * @return object
     */
    public function ConsignmentTrackingGetConsignmentDetailsV3($params)
    {
        $Request = [
            'ConsignmentNumber' => '',
            'ConsignmentKey' => '',
        ];

        $Request = array_merge($Request, $params);

        return $this->Request('ConsignmentTrackingGetConsignmentDetailsV3', $Request, 'tracking');
    }

    /**
     * Get Full Details of consignment tracking
     *
     * @param $params
     * @return object
     */
    public function ConsignmentTrackingGetFullDetailsV3($params)
    {
        $Request = [
            'ConsignmentNumber' => '',
            'ConsignmentKey' => '',
        ];

        $Request = array_merge($Request, $params);

        return $this->Request('ConsignmentTrackingGetFullDetailsV3', $Request, 'tracking');
    }
}
