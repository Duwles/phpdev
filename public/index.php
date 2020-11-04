<?php
declare(strict_types=1);
$loader = require __DIR__."/../app/bootstrap.php";

// For security reasons, Tracy is visible only on localhost.
// You may force Tracy to run in development mode by passing the Debugger::DEVELOPMENT instead of Debugger::DETECT.
// Debugger::enable(Debugger::PRODUCTION);