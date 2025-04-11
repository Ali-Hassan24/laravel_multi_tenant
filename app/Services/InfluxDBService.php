<?php

namespace App\Services;

use InfluxDB2\Client;

class InfluxDBService
{
    protected $client;
    protected $queryApi;

    public function __construct()
    {
        $this->client = new Client([
            "url" => config('influxdb.url'),
            "token" => config('influxdb.token'),
            "bucket" => config('influxdb.bucket'),
            "org" => config('influxdb.org'),
        ]);

        $this->queryApi = $this->client->createQueryApi();
    }

    public function fetchData(string $fluxQuery)
    {
        return $this->queryApi->query($fluxQuery);
    }
}
