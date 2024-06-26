<?php


namespace App\Logging;


class CustomizeFormatter
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        $json = new \Monolog\Formatter\JsonFormatter();
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($json);
        }
    }
}
