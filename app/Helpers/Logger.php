<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class Logger
{
  /**
   * debug
   * 顯示偵錯的檔案及那一行
   * @param  mixed $msg
   * @param  mixed $file
   * @param  mixed $line
   * @return void
   */
  public static function debug($msg, $file, $line)
  {
    Log::debug(sprintf("<FileName>%s <Line> line:%d <DebugMessage> %s", $file, $line, $msg));
  }
}
