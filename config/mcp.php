<?php

return [
    'doc_api_url' => env('MCP_DOC_API_URL', 'https://boost.laravel.com'),
    'packages' => [
        [
            'name' => 'laravel/framework',
            'version' => env('MCP_LARAVEL_VERSION', '12.x'),
        ],
        [
            'name' => 'filament/filament',
            'version' => env('MCP_FILAMENT_VERSION', '3.x'),
        ],
        [
            'name' => 'inertiajs/inertia-laravel',
            'version' => env('MCP_INERTIA_VERSION', '2.x'),
        ],
        [
            'name' => 'livewire/flux',
            'version' => env('MCP_FLUX_VERSION', '2.x'),
        ],
        [
            'name' => 'livewire/flux-pro',
            'version' => env('MCP_FLUX_PRO_VERSION', '2.x'),
        ],
        [
            'name' => 'livewire/livewire',
            'version' => env('MCP_LIVEWIRE_VERSION', '3.x'),
        ],
        [
            'name' => 'livewire/volt',
            'version' => env('MCP_VOLT_VERSION', '3.x'),
        ],
        [
            'name' => 'laravel/nova',
            'version' => env('MCP_NOVA_VERSION', '5.x'),
        ],
        [
            'name' => 'pestphp/pest',
            'version' => env('MCP_PEST_VERSION', '4.x'),
        ],
        [
            'name' => 'tailwindcss',
            'version' => env('MCP_TAILWIND_VERSION', '4.x'),
        ],
    ],
];
