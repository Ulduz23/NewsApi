<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected int $limit;
    protected int $offset;
    private array $respons;
    public function __construct()
    {
        
        $limit  = (int) request()->get('limit');
        $offset = (int) request()->get('page');
        $this->limit = empty($limit) || !is_int($limit) || $limit <= 0 ? 15 : $limit;
        $this->offset = empty($offset) || !is_int($offset) || $offset <= 0 ? 1 : $offset;

        $this->respons = [
            'errors' => [
                'message' => null,
            ],
            'success' => [
                'message' => null,
            ],
            'operation' => true,
            'status' => null,
            'data' => null,
        ];
    }

    protected function sendResponse($data, $totalCount = 1, $message = 'OK', $status = 200)
    {
        $this->respons['success']['message'] = $message;
        $this->respons['status'] = $status;
        $this->respons['data'] = $data;

        if (is_iterable($data)) {
            $this->respons['count']['total_count'] = $totalCount;
            $this->respons['count']['offset'] = $this->offset;
            $this->respons['count']['limit'] = is_iterable($data) ? $this->limit : 1;
        }

        return response()->json($this->respons, $status);
    }

    protected function sendResponseOperation($message = 'OK', $status = 200)
    {
        $this->respons['success']['message'] = $message;
        $this->respons['status'] = $status;
        return response()->json($this->respons, $status);
    }
}
