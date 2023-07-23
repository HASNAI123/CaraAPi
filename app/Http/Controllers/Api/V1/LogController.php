<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function index()
    {
        // Get the log entries from the Laravel log file
        $logData = $this->parseLogFile(storage_path('logs/laravel.log'));

        return response()->json($logData);
    }

    private function parseLogFile($filePath)
    {
        // Read the log file and parse the log entries
        $logs = [];
        $fileContents = file_get_contents($filePath);

        preg_match_all('/\[([^\]]+)\]\s(\w+):\s(.+)/', $fileContents, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $logs[] = [
                'timestamp' => $match[1],
                'level' => $match[2],
                'message' => $match[3],
            ];
        }

        return $logs;
    }
}
