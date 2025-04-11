<?php

namespace App\Http\Controllers;
use App\Services\InfluxDBService;
use Illuminate\Http\Request;

class InfluxController extends Controller
{

    public function show(InfluxDBService $influx)
    {
        $fluxQuery = <<<EOL
    from(bucket: "your-bucket-name")
      |> range(start: -1h)
      |> filter(fn: (r) => r._measurement == "your_measurement")
EOL;

        $tables = $influx->fetchData($fluxQuery);

        $data = [];
        foreach ($tables as $table) {
            foreach ($table->records as $record) {
                $data[] = [
                    'time' => $record->getTime(),
                    'field' => $record->getField(),
                    'value' => $record->getValue(),
                ];
            }
        }

        return response()->json($data);
    }

}
