<?php

use App\Mcp\Servers\Documentation;
use Laravel\Mcp\Server\Facades\Mcp;

Mcp::local('doc', Documentation::class);
