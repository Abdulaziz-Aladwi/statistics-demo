<?php

namespace App\Console\Commands;

use PDOException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\Database\DatabaseConfigurationService;

class createDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-database {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create database';

    /**
     * @param DatabaseConfigurationService
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dbName = $this->argument('name');
        $config = config('database.connections.mysql');

        try {
            $pdo = new \PDO("mysql:host={$config['host']};charset={$config['charset']}", $config['username'], $config['password']);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName`");
            $this->info("Database '$dbName' created successfully.");
        } catch (PDOException $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }
    }
}
