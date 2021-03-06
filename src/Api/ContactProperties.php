<?php namespace Fungku\HubSpot\Api;

class ContactProperties extends Api
{
    /**
     * Get all Contact properties.
     *
     * @param array $params Optional parameters ['limit', 'offset', 'created', 'deleted_at', 'name']
     * @return mixed
     */
    public function all(array $params = [])
    {
        $endpoint = '/contacts/v1/properties';

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Create a new property.
     *
     * @param array $property
     * @return mixed
     */
    public function create(array $property)
    {
        $endpoint = "/contacts/v1/properties/{$property['name']}";

        $options['json'] = $property;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Update a property.
     *
     * @param array $property
     * @return mixed
     */
    public function update(array $property)
    {
        $endpoint = "/contacts/v1/properties/{$property['name']}";

        $options['json'] = $property;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete a property.
     *
     * @param $name
     * @return mixed
     */
    public function delete($name)
    {
        $endpoint = "/contacts/v1/properties/{$name}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get contact property group.
     *
     * @param $group_name
     * @return mixed
     */
    public function getGroup($group_name)
    {
        $endpoint = "/contacts/v1/groups/{$group_name}";

        return $this->request('get', $endpoint);
    }

    /**
     * Create a contact property group.
     *
     * @param array $group Group properties
     * @return mixed
     */
    public function createGroup(array $group)
    {
        $endpoint = "/contacts/v1/groups/{$group['name']}";

        $options['json'] = $group;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Update a property group.
     *
     * @param array $group
     * @return mixed
     */
    public function updateGroup(array $group)
    {
        $endpoint = "/contacts/v1/groups/{$group['name']}";

        $options['json'] = $group;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete a property group.
     *
     * @param $group_name
     * @return mixed
     */
    public function deleteGroup($group_name)
    {
        $endpoint = "/contacts/v1/groups/{$group_name}";

        return $this->request('delete', $endpoint);
    }
}
