<?php

namespace App\Traits;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;

trait PowerBITrait
{
    /**
     * @throws GuzzleException
     */
    protected function getUserAccessToken(): mixed
    {
        $user_id = config('power-bi.user_id');

        $client = new Client([
            'base_uri' => "https://login.microsoftonline.com/$user_id/oauth2/token",
        ]);

        $response = $client->request('POST', "https://login.microsoftonline.com/$user_id/oauth2/token", [
            'multipart' => [
                [
                    'name' => 'resource',
                    'contents' => config('power-bi.resource'),
                ],
                [
                    'name' => 'grant_type',
                    'contents' => config('power-bi.grant_type'),
                ],
                [
                    'name' => 'client_secret',
                    'contents' => config('power-bi.client_secret'),
                ],
                [
                    'name' => 'client_id',
                    'contents' => config('power-bi.client_id'),
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @throws GuzzleException
     */
    protected function getReportsInGroup($group_id): array
    {
        $userAccessToken = Session::get('power_access_token')[0]->access_token;

        $client = new Client([
            'base_uri' => 'https://api.powerbi.com/v1.0/myorg',
        ]);

        $headers = [
            'Authorization' => "Bearer $userAccessToken",
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $response = $client->request('GET', "https://api.powerbi.com/v1.0/myorg/groups/$group_id/reports", [
            'headers' => $headers,
        ]);

        return json_decode($response->getBody()->getContents())->value;
    }

    /**
     * @throws GuzzleException
     */
    protected function getReportAccessToken($userAccessToken, $report): object
    {
        try {
            $client = new Client([
                'base_uri' => 'https://api.powerbi.com',
            ]);

            $headers = [
                'Authorization' => "Bearer $userAccessToken",
                'Content-type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $params = (object) [
                'accessLevel' => $report->access_level,
                'datasetId' => $report->dataset_id,
            ];

            $response = $client->request('POST', "https://api.powerbi.com/v1.0/myorg/groups/$report->group_id/reports/$report->report_id/GenerateToken", [
                'headers' => $headers,
                'json' => $params,
            ]);

            $resp = json_decode($response->getBody()->getContents());

            return (object) [
                'status' => 200,
                'tokenId' => $resp->tokenId,
                'token' => $resp->token,
                'expiration' => $resp->expiration,
            ];
        } catch (Exception $e) {
            return (object) [
                'status' => 500,
                'message' => $e->getMessage(),
            ];
        }
    }
}
