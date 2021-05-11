<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait Api
{
    /**
     * @param  string  $message
     * @param  null|array  $data
     * @param  int  $code
     * @return Response
     */
    public function success($message = 'success', $data = null, $code = 1)
    {
        return $this->result($data, $message, $code);
    }

    /**
     * @param $message
     * @param  int  $code
     * @param  null|array  $data
     * @return Response
     */
    public function error($message, $code = 0, $data = null)
    {
        return $this->result($data, $message, $code);
    }

    /**
     * @param  null|array  $data
     * @param  string  $message
     * @param  int  $code
     * @return Response
     */
    public function result($data = null, $message = 'success', $code = 1)
    {
        if (!$data) {
            $data = new \stdClass();
        }

        return response(compact('code', 'message', 'data'));
    }
}
