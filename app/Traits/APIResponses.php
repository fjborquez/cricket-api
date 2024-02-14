<?php

namespace App\Traits;

trait APIResponses {
    public function ok(array $data) {
        return $this->response(200, $data);
    }

    public function created(array $data) {
        return $this->response(201, $data);
    }

    public function unauthorized(array $data) {
        return $this->response(401, $data);
    }

    private function response(int $code, array $data) {
        return response()->json($data, $code);
    }
}
