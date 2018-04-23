<?php
declare(strict_types=1);

namespace Farol360\IsepeEventos\Model;

use Farol360\IsepeEventos\Model;
use Farol360\IsepeEventos\Model\Permission;
use GuzzleHttp\Client;

class PermissionModel extends Model
{
    public function add(Permission $permission)
    {
        $client = new Client();
        $response = $client->request('POST', $this->baseUrl . 'permissions', ['json' => $permission, 'auth' => ['root', 'root']]);
        if ($response->getStatusCode() == 200) {
            return $response;
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $client = new Client();
        $response = $client->request('DELETE', $this->baseUrl . 'permissions/'. $id, [
            'auth' => ['root', 'root']
        ]);
        if ($response->getStatusCode() == 200) {
            return true;
        }
        return false;
    }

    public function get(int $id)
    {
        $client = new Client();
        $response = $client->request('GET', $this->baseUrl . 'permissions/'. $id, [
            'auth' => ['root', 'root']
        ]);
        return json_decode((string)$response->getBody());
    }

    public function getAll(): array
    {
        $client = new Client();
        $response = $client->request('GET', $this->baseUrl . 'permissions', [
            'auth' => ['root', 'root']
        ]);
        return json_decode((string)$response->getBody());
    }

    public function update(Permission $permission): bool
    {
        $client = new Client();
        $response = $client->request('PUT', $this->baseUrl . 'permissions/'. $permission->id, ['json' => $permission, 'auth' => ['root', 'root']]);
        if ($response->getStatusCode() == 200) {
            return true;
        }
        return false;
    }
}
