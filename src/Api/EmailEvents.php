<?php namespace Fungku\HubSpot\Api;

class EmailEvents extends Api
{
    /**
     * Get campaign IDs for a portal.
     *
     * @param array $params Optional parameters
     * @return mixed
     */
    public function getCampaignIds(array $params = [])
    {
        $endpoint = "/email/public/v1/campaigns";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get campaign data for a given campaign.
     *
     * @param int $campaign_id
     * @param int $application_id
     * @return mixed
     */
    public function getCampaignById($campaign_id, $application_id)
    {
        $endpoint = "/email/public/v1/campaigns/{$campaign_id}";

        $options['query'] = ['appId' => $application_id];

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get email events for a campaign or recipient.
     *
     * @param array $params Optional parameters
     * @return mixed
     */
    public function get(array $params)
    {
        $endpoint = "/email/public/v1/events";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get event data for a specific event.
     *
     * @param int $id The event ID
     * @param int $created Timestamp (milliseconds) when the event was created
     * @return mixed
     */
    public function getById($id, $created)
    {
        $endpoint = "/email/public/v1/events/{$created}/{$id}";

        return $this->request('get', $endpoint);
    }

}
