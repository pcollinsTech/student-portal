<?php


namespace App\Helpers;

class Response
{

  public static function Success($msg, $data = [])
  {
    $payload = ['result' => true, 'msg' => $msg, 'data' => $data];
    return response()->json($payload);
  }

  public static function Error($msg, $data = [])
  {
    $payload = ['result' => false, 'msg' => $msg, 'data' => $data];
    return response()->json($payload);
  }
}
