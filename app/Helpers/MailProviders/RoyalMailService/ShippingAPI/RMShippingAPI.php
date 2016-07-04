<?php
/**
 *  Royal Mail Shipping API(SOAP)
 *
 *  Integrated for DepotDash
 *
 * @author Gevorg Hovsepyan <hovsepyan.gev1@gmail.com>
 *
 * @category RoyalMailProviders
 * @package RoyalMailService
 *
 * @todo Not finished yet
 */

namespace App\Helpers\MailProviders\RoyalMailService;

class RMShippingAPI {

    /** @var string $endpoint */
    protected $endpoint = 'https://api.royalmail.net/shipping/v2';

    protected $credentials;

    function __construct($params = [])
    {
        $this->credentials = [
            'clientID' => env('PROVIDER_RM_CLIENT_ID'),
            'secretID' => env('PROVIDER_RM_SECRET_ID')
        ];
    }

    protected function Request($method, $params = [])
    {
        $RequestParams = [];

        return $this->SoapClient($method, $RequestParams);
    }

    /**
     * @param $method
     * @param array $params
     * @return mixed
     * @todo Some improvements are needed. waiting for RM support answer
     */
    public function SoapClient($method, $params = [])
    {
        $password = 'Password2014!';

        $date = gmdate('Y-m-d\TH:i:s\Z');
        $nonce = mt_rand();
        $nonce_date_pwd = pack("A*",$nonce) . pack("A*",$date) . pack("H*", sha1($password));
        $encoded_password = base64_encode(pack('H*',sha1($nonce_date_pwd)));
        $encoded_nonce = base64_encode($nonce);

        $security = [
            'UsernameToken' => [
                'Username' => 'depotdashlimitedAPI',
                'Password' => $encoded_password,
                'Nonce' => $encoded_nonce,
                'Created' =>  $date,
            ]
        ];
dd($security);
        $params = $this->prepareParams($params);

        //app_path("Helpers/MailProviders/RoyalMailService/ShippingAPI/ShippingAPI_V2_0_9.wsdl")
        $client = new \SoapClient(null, array(
            'location'   => $this->endpoint,
            'uri' => 'https://api.royalmail.net/shipping',
            'trace' => 1,
            'exceptions' => 1,
            'soap_version'   => SOAP_1_2,
            'cache_wsdl' => WSDL_CACHE_NONE,
//            'stream_context' => stream_context_create(
//                [
//                    'http' =>
//                        [
//                            'header' => implode(
//                                "\r\n",
//                                [
//                                    'Accept: application/soap+xml',
//                                    'X-IBM-Client-Id: ' . $this->credentials['clientID'],
//                                    'X-IBM-Client-Secret: ' . $this->credentials['secretID'],
//                                ]
//                            ),
//                        ],
//                ]
//            )
        ));

        $header = new \SoapHeader('wsse','Security',$this->prepareParams($security), false);
//
        $client->__setSoapHeaders($header);

        try {
            $response = $client->__soapCall($method, array($params));
        }
        catch (\SoapFault $soapFault) {
            dd($soapFault);
        }

        return $response;
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

    public function createManifest()
    {

    }

    /**
     * Create new shipment
     *
     * * Request parameters *
     * shipmentType
     *   * identifier   (string) maxLength - 128
     *   * code         (string) maxLength - 128
     *   * name         (string) maxLength - 128
     *   * description  (string) maxLength - 256
     * serviceOccurrence (integer)
     * serviceType
     *   * identifier   (string) maxLength - 128
     *   * code         (string) maxLength - 128
     *   * name         (string) maxLength - 128
     *   * description  (string) maxLength - 256
     * serviceOffering
     *   * identifier   (string) maxLength - 128
     *   * code         (string) maxLength - 128
     *   * name         (string) maxLength - 128
     *   * description  (string) maxLength - 256
     * serviceFormat
     *   * identifier   (string) maxLength - 128
     *   * code         (string) maxLength - 128
     *   * name         (string) maxLength - 128
     *   * description  (string) maxLength - 256
     * bfpoFormat
     *   * identifier   (string) maxLength - 128
     *   * code         (string) maxLength - 128
     *   * name         (string) maxLength - 128
     *   * description  (string) maxLength - 256
     * serviceEnhancements
     *   * identifier   (string) maxLength - 128
     *   * code         (string) maxLength - 128
     *   * name         (string) maxLength - 128
     *   * description  (string) maxLength - 256
     * signature    (boolean)
     * shippingDate (date)
     * recipientContact
     *   * name         (string) maxLength - 128
     *   * telephoneNumber
     *      * countryCode       (integer)
     *      * complementaryName (string) maxLength - 128
     *      * areaCode          (integer)
     *      * telephoneNumber   (integer)
     *      * extensionNumber   (integer)
     *      * speedDialNumber   (integer)
     *   * electronicAddress    (string) maxLength - 256
     * recipientAddress
     *   * addressUsageType
     *      * identifier   (string) maxLength - 128
     *      * code         (string) maxLength - 128
     *      * name         (string) maxLength - 128
     *      * description  (string) maxLength - 256
     *   * domesticIndicator    (boolean)
     *   * buildingName         (string) maxLength - 64
     *   * buildingNumber       (integer) 
     *   * addressLine1         (string) maxLength - 256
     *   * addressLine2         (string) maxLength - 256
     *   * addressLine3         (string) maxLength - 256
     *   * addressLine4         (string) maxLength - 256
     *   * stateOrProvince
     *      * identifier   (string) maxLength - 128
     *      * code         (string) maxLength - 128
     *      * name         (string) maxLength - 128
     *      * description  (string) maxLength - 256
     *   * postTown     (string) maxLength - 64
     *   * county
     *      * identifier   (string) maxLength - 128
     *      * code         (string) maxLength - 128
     *      * name         (string) maxLength - 128
     *      * description  (string) maxLength - 256
     *   * postcode     (string) maxLength - 128
     *   * country
     *      * identifier   (string) maxLength - 128
     *      * code         (string) maxLength - 128
     *      * name         (string) maxLength - 128
     *      * description  (string) maxLength - 256
     *   * status
     *      * status
     *          * identifier   (string) maxLength - 128
     *          * code         (string) maxLength - 128
     *          * name         (string) maxLength - 128
     *          * description  (string) maxLength - 256
     *      * validFrom     (dateTime)
     *      * validTo     (dateTime)
     *   * audit
     *      * lastUpdateDate    (dateTime)
     *      * lastUpdateUserIdentifier    (string) maxLength - 128
     * - items
     *     - item
     *          * numberOfItems     (integer)
     *          - weight
     *              - unitOfMeasure
     *                  * identifier   (string) maxLength - 128
     *                  * code         (string) maxLength - 128
     *                  * name         (string) maxLength - 128
     *                  * description  (string) maxLength - 256
     *              * value     (float)
     *          - offlineShipments
     *              * shipmentNumber    (string) maxLength - 128
     *              * itemID            (string) maxLength - 128
     *              - shipmentNumber
     *                  * status
     *                      * identifier   (string) maxLength - 128
     *                      * code         (string) maxLength - 128
     *                      * name         (string) maxLength - 128
     *                      * description  (string) maxLength - 256
     *                  * validFrom     (dateTime)
     *                  * validTo     (dateTime)
     * - departmentReference    (string) maxLength - 128
     * - customerReference    (string) maxLength - 128
     * - senderReference    (string) maxLength - 128
     * - safePlace          (string) maxLength - 4000
     * - importerContact    - like recipientContact
     * - importerAddress    - like recipientAddress
     * - internationalInfo
     *      * parcels
     *          * parcel unbounded
     *              * weight
     *              * length
     *              * height
     *              * width
     *              * purposeOfShipment
     *              * explanation
     *              * invoiceNumber
     *              * exportLicenseNumber
     *              * certificateNumber
     *              * contentDetails
     *              * fees
     *              * offlineShipments
     *      * shipperExporterVatNo   (string) maxLength - 128
     *      * recipientImporterVatNo   (string) maxLength - 128
     *      * originalExportShipmentNo   (string) maxLength - 128
     *      * documentsOnly     (boolean)
     *      * documentsDescription   (string) maxLength - 128
     *      * shipmentDescription   (string) maxLength - 128
     *      * comments   (string) maxLength - 512
     *      * invoiceDate   (date)
     *      * termsOfDelivery   (string) maxLength - 512
     *      * purchaseOrderRef   (string) maxLength - 128
     */
    public function createShipment()
    {
        //@todo Waiting RM support answer.
    }

    public function printDocument()
    {

    }

    public function printLabel()
    {

    }

    public function printManifest()
    {

    }

    public function request1DRanges()
    {

    }

    public function request2DItemIDRange()
    {

    }

    public function updateShipment()
    {

    }

    public function cancelShipment()
    {
        // @todo Testing data
        $Request = [
            'integrationHeader' => [
                'dateTime' => date('Y-m-d\TH:i:s'),
                'version' => 2,
                'identification' => [
                    'applicationId' => 'RMG-API-G-01',
                    'transactionId' => '78945663211'
                ],
                'testFlag' => true,
                'debugFlag' => true,
                'performanceFlag' => false

            ],
            'cancelShipments' => [
                'shipmentNumber' => 'TTT003070765GB'
            ]
        ];

        $this->SoapClient('cancelShipment', $Request);
    }
}