<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected $systemLocale;
    protected $translatableLocales;

    public function __construct()
    {
        $this->systemLocale = config('app.locale');
        $this->translatableLocales = config('translatable.locales');
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {

        throw new HttpResponseException(response()->json([
            'errors' => [
                'message' => $this->transformedErrors($validator->errors()->toArray()),
            ],
            'success' => [
                'message' => null,
            ],
            'operation' => false,
            'data' => null,
            'status' => 422,
        ], 422));
    }

    private function transformedErrors(array $errors): array
    {
        $transformedErrors = [];

        foreach ($errors as $key => $value) {
            $parts = explode(".", $key);
            $field = $parts[0];
            $index = isset($parts[1]) ? $parts[1] : null;

            if ($index !== null) {
                $transformedErrors[$field][$index] = str_replace('.', ' ', $value[0]);
            } else {
                $transformedErrors[$field] = [$value[0]];
            }
        }
        return $transformedErrors;
    }
}
