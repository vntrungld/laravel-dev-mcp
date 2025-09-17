<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\Search;
use Laravel\Mcp\Server;

class Documentation extends Server
{
    public string $serverName = 'Documentation Server';

    public string $serverVersion = '0.0.1';

    public string $instructions = 'Laravel Documentation MCP server offering semantic documentation search. Boost helps with code generation.';

    public array $tools = [
        Search::class,
    ];

    public array $resources = [
        // ExampleResource::class,
    ];

    public array $prompts = [
        // ExamplePrompt::class,
    ];
}
