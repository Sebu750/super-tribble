<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseQueryBuilder
{
    protected string $table;
    protected string $url;
    protected string $apiKey;
    protected array $query = [];

    public function __construct(string $table, string $url, string $apiKey)
    {
        $this->table = $table;
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

    /**
     * Select specific columns
     */
    public function select(string $columns = '*'): self
    {
        $this->query['select'] = $columns;
        return $this;
    }

    /**
     * Filter with where clause
     */
    public function where(string $column, string $operator, mixed $value = null): self
    {
        if ($value === null) {
            $value = $operator;
            $operator = 'eq';
        }

        $this->query[$column] = "{$operator}.{$value}";
        return $this;
    }

    /**
     * Order results
     */
    public function orderBy(string $column, bool $ascending = true): self
    {
        $this->query['order'] = "{$column}." . ($ascending ? 'asc' : 'desc');
        return $this;
    }

    /**
     * Limit results
     */
    public function limit(int $count): self
    {
        $this->query['limit'] = $count;
        return $this;
    }

    /**
     * Get all results
     */
    public function get(): array
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get("{$this->url}/rest/v1/{$this->table}", $this->query);

        $json = $response->json();
        if (!is_array($json)) return [];
        // Ensure it's a sequential array (list), not an associative array (error response)
        if (!array_is_list($json) && !empty($json)) return [];
        return $json;
    }

    /**
     * Get first result
     */
    public function first(): ?array
    {
        $results = $this->limit(1)->get();
        if (empty($results)) return null;
        $first = reset($results);
        return is_array($first) ? $first : null;
    }

    /**
     * Insert data
     */
    public function insert(array $data): array
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
            'Prefer' => 'return=representation',
        ])->post("{$this->url}/rest/v1/{$this->table}", $data);

        $json = $response->json();
        return is_array($json) ? $json : [];
    }

    /**
     * Update data
     */
    public function update(array $data): array
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
            'Prefer' => 'return=representation',
        ])->patch("{$this->url}/rest/v1/{$this->table}", $this->query, $data);

        return $response->json() ?? [];
    }

    /**
     * Delete data
     */
    public function delete(): array
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => "Bearer {$this->apiKey}",
            'Prefer' => 'return=representation',
        ])->delete("{$this->url}/rest/v1/{$this->table}", $this->query);

        return $response->json() ?? [];
    }
}
