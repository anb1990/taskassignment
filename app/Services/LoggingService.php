<?php
namespace App\Services;

use Psr\Log\LoggerInterface;

class LoggingService
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logInfo($message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    public function logError($message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

  
}