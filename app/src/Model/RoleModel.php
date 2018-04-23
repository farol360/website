<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\Role;
use GuzzleHttp\Client;

class RoleModel extends Model
{
    public function add(Role $role)
    {
        $client = new Client();
        $response = $client->request('POST', $this->baseUrl . 'roles', ['json' => $role, 'auth' => ['root', 'root']]);
        if ($response->getStatusCode() == 200) {
            return $response;
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $client = new Client();
        $response = $client->request('DELETE', $this->baseUrl . 'roles/'. $id, [
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
        $response = $client->request('GET', $this->baseUrl . 'roles/'. $id, [
            'auth' => ['root', 'root']
        ]);
        return json_decode((string)$response->getBody());
    }

    public function getAll(): array
    {
        $client = new Client();
        $response = $client->request('GET', $this->baseUrl . 'roles', [
            'auth' => ['root', 'root']
        ]);
        return json_decode((string)$response->getBody());
    }

    public function update(Role $role): bool
    {
        $client = new Client();
        $response = $client->request('PUT', $this->baseUrl . 'roles/'. $role->id, ['json' => $role, 'auth' => ['root', 'root']]);
        if ($response->getStatusCode() == 200) {
            return true;
        }
        return false;
    }
}
