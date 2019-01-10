<?php

use App\App;

// Success response to request
http_response_code(200);
fastcgi_finish_request();

$app = new App();
$app->run();