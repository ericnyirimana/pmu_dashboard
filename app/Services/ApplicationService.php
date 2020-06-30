<?php


namespace App\Services;


use App\Models\Application;
use Illuminate\Support\Facades\Log;

class ApplicationService
{

    public function __construct(){
    }

    /**
     * @param string $key
     * @return string
     */
    public function getValue(string $key) : string {
        try {
            $result = Application::where('key', $key)->select('value')->first();
            return $result->value;
        } catch (\Throwable $e){
            Log::warning('Value not found in Application table ( key: {'. $key . '})');
            return null;
        }
    }
}
