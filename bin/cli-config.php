<?php

//php ../vendor/doctrine/orm/bin/doctrine.php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once '../bootstrap.php';
return ConsoleRunner::createHelperSet($em);