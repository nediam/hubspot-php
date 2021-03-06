<?php namespace Fungku\HubSpot\Api;

use Fungku\HubSpot\Contracts\HttpClient;

abstract class Api
{
    /**
     * @var string HubSpot API key
     */
    protected $apiKey;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var string Base url
     */
    protected $baseUrl = "https://api.hubapi.com";

    /**
     * Default user agent.
     */
    const USER_AGENT = 'Fungku_HubSpot_PHP/0.1 (https://github.com/fungku/hubspot-php)';

    /**
     * @param string $apiKey
     * @param HttpClient $client
     */
    public function __construct($apiKey, HttpClient $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    /**
     * Send the request to the HubSpot API.
     *
     * @param string $method The HTTP request verb.
     * @param string $url The url to send the request to.
     * @param array $options An array of options to send with the request.
     * @return mixed
     */
    protected function requestUrl($method, $url, array $options =[])
    {
        $options['headers']['User-Agent'] = self::USER_AGENT;

        return $this->client->$method($url, $options);
    }

    /**
     * Send the request to the HubSpot API.
     *
     * @param string $method The HTTP request verb.
     * @param string $endpoint The HubSpot API endpoint.
     * @param array $options An array of options to send with the request.
     * @param string $queryString A query string to send with the request.
     * @return mixed
     */
    protected function request($method, $endpoint, array $options = [], $queryString = null)
    {
        $url = $this->generateUrl($endpoint, $queryString);

        return $this->requestUrl($method, $url, $options);
    }

    /**
     * Generate the full endpoint url, including query string.
     *
     * @param string $endpoint The HubSpot API endpoint.
     * @param string $queryString The query string to send to the endpoint.
     * @return string
     */
    protected function generateUrl($endpoint, $queryString = null)
    {
        return $this->baseUrl . $endpoint . '?hapikey=' . $this->apiKey . $queryString;
    }

    /**
     * Generate a query string for batch requests.
     * Multiple items with the same variable name, not something PHP generally likes.
     *
     * @param string $varName The name of the query variable.
     * @param array $items An array of item values for the variable.
     * @return string
     */
    protected function generateBatchQuery($varName, array $items)
    {
        $queryString = '';
        foreach ($items as $item) {
            $queryString .= "&{$varName}={$item}";
        }

        return $queryString;
    }

    /**
     * Check an array of properties for a required property.
     *
     * @param string $required
     * @param array $properties
     * @return bool
     */
    protected function hasRequiredProperty($required, array $properties)
    {
        $result = false;

        foreach ($properties as $property) {
            if (is_array($property)) {
                $result = $this->hasRequiredProperty($required, $property);
            } else {
                $result = ($required == $property);
            }
            if ($result == true) {
                break;
            }
        }

        return $result;
    }
}
