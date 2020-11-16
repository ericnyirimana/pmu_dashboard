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
    public function getValue($key) {
        try {
            $result = Application::where('key', $key)->select('value', 'type')->first();
            return $this->convertValue($result->value, $result->type);
        } catch (\Throwable $e){
            Log::warning('Value not found in Application table ( key: {'. $key . '})');
            return null;
        }
    }

    private function convertValue($value, $type) {
        switch ($type) {
            case 'INT':
                $value = intval($value);
                break;
            case 'FLOAT':
            case 'DOUBLE':
                $value = floatval($value);
                break;
            case 'BOOLEAN':
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                break;
            case 'JSON':
                $value = json_decode($value, true);
                break;
            default:
                $value = '' . $value;
                break;
        }
        return $value;
    }

    public function concatenateArrayValue($arrayValue, $stringConcatenate) {

        $finalValue = array();
        foreach($arrayValue as $values){
            $value = $values.' '.$stringConcatenate;
            array_push($finalValue, $value);
        }
        $combinedValues = array_combine($arrayValue, $finalValue);
        return $combinedValues;

    }
}