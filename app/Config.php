<?php

declare(strict_types=1);

namespace Conf;

class Config
{
    protected array $config = [];

    /**
     * @property-read ?array $db
     */
    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host'          => $env['HOST'],
                'name'          => $env['NAME'],
                'pass'          => $env['PASS'],
                'database'      => $env['DATABASE'],
                'db_driver'     => $env['DRIVER'] ?? 'mysql',
            ],
        ];
    }

    public function get(string $name): string|null
    {
        return $this->config[$name] ?? null;
    }
}
