<?php

namespace App\Mcp\Tools;

use App\Concerns\MakesHttpRequests;
use Generator;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\Title;
use Laravel\Mcp\Server\Tools\ToolInputSchema;
use Laravel\Mcp\Server\Tools\ToolResult;

#[Title('Search Documentation')]
class Search extends Tool
{
    use MakesHttpRequests;

    /**
     * A description of the tool.
     */
    public function description(): string
    {
        return 'Search for up-to-date version-specific documentation related to this project and its packages. This tool will search Laravel hosted documentation based on the packages installed and is perfect for all Laravel ecosystem packages. Laravel, Inertia, Pest, Livewire, Filament, Nova, Tailwind, and more.'
            .PHP_EOL
            .'You must use this tool to search for Laravel-ecosystem docs before using other approaches. The results provided are for this project\'s package version and does not cover all versions of the package.';
    }

    /**
     * The input schema of the tool.
     */
    public function schema(ToolInputSchema $schema): ToolInputSchema
    {
        return $schema
            ->raw('queries', [
                'description' => 'List of queries to perform, pass multiple if you aren\'t sure if it is "toggle" or "switch", for example',
                'type' => 'array',
                'items' => [
                    'type' => 'string',
                    'description' => 'Search query',
                ],
            ])->required()
            ->raw('packages', [
                'description' => 'Package names to limit searching to from application-info. Useful if you know the package(s) you need. i.e. laravel/framework, inertiajs/inertia-laravel, @inertiajs/react',
                'type' => 'array',
                'items' => [
                    'type' => 'string',
                    'description' => "The composer package name (e.g., 'symfony/console')",
                ],
            ])
            ->integer('token_limit')
            ->description('Maximum number of tokens to return in the response. Defaults to 10,000 tokens, maximum 1,000,000 tokens.')
            ->optional();
    }

    /**
     * Execute the tool call.
     *
     * @return ToolResult|Generator
     */
    public function handle(array $arguments): ToolResult|Generator
    {
        $apiUrl = config('mcp.doc_api_url', 'https://boost.laravel.com').'/api/docs';
        $packagesFilter = array_key_exists('packages', $arguments) ? $arguments['packages'] : null;

        $queries = array_filter(
            array_map('trim', $arguments['queries']),
            fn($query) => $query !== '' && $query !== '*'
        );

        $packagesCollection = collect(config('mcp.packages'));

        $packages = [];
        // Only search in specific packages
        if ($packagesFilter) {
            $packages = $packagesCollection
                ->filter(fn ($package) => in_array($package['name'], $packagesFilter))
                ->values()
                ->toArray();
        }

        $tokenLimit = $arguments['token_limit'] ?? 10000;
        $tokenLimit = min($tokenLimit, 1000000); // Cap at 1M tokens

        $payload = [
            'queries' => $queries,
            'packages' => $packages,
            'token_limit' => $tokenLimit,
            'format' => 'markdown',
        ];

        try {
            $response = $this->client()->asJson()->post($apiUrl, $payload);

            if (!$response->successful()) {
                return ToolResult::error('Failed to search documentation: '
                    .$response->body());
            }
        } catch (\Throwable $e) {
            return ToolResult::error('HTTP request failed: '.$e->getMessage());
        }

        return ToolResult::text($response->body());
    }
}
