<?php

class ApiView {

    public function response($status, $data = null) {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        echo json_encode($data);
    }

    private function _requestStatus($code) {
        $status = array(
            200 => "Ok",
            201 => "Created",
            204 => "No response",
            400 => "Bad request",
            404 => "Not found",
            500 => "Internal server error"
        );
        //return (isset($status[$code])) ? $status[$code] : $status[500];
        if ( isset($status[$code])) {
            return $status[$code];
        } else {
            return $status[500];
        }
    }
}