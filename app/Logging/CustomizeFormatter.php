<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $output = "%datetime% [%level_name%] SESSIONID=[\"%context.session_id%\"] %message%\n";
            $formatter = new LineFormatter($output, "Y/m/d H:i:s.v", true, true);
            $handler->setFormatter($formatter);
        }
    }
}
