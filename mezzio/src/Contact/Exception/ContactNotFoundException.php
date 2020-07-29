<?php

declare(strict_types=1);

namespace Contact\Exception;

use Exception;
use Throwable;

class ContactNotFoundException extends Exception
{
    public function __construct(int $contactId, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Contact with ID: %s not found', $contactId), $code, $previous);
    }
}