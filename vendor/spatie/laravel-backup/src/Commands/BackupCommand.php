<?php

namespace Spatie\Backup\Commands;

use Exception;
use Spatie\Backup\Events\BackupHasFailed;
use Spatie\Backup\Exceptions\InvalidCommand;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupCommand extends BaseCommand
{
    /**
     * @var string
     */
    protected $signature = 'backup:run {--filename=} {--only-db} {--only-files} {--only-to-disk=}';

    /**
     * @var string
     */
    protected $description = 'run to backup.';

    public function handle()
    {
        consoleOutput()->comment('start to backup....');

        try {
            $this->guardAgainstInvalidOptions();

            $backupJob = BackupJobFactory::createFromArray(config('laravel-backup'));

            if ($this->option('only-db')) {
                $backupJob->doNotBackupFilesystem();
            }

            if ($this->option('only-files')) {
                $backupJob->doNotBackupDatabases();
            }

            if ($this->option('only-to-disk')) {
                $backupJob->backupOnlyTo($this->option('only-to-disk'));
            }

            if ($this->option('filename')) {
                $backupJob->setFilename($this->option('filename'));
            }

            $backupJob->run();

            consoleOutput()->comment('The backup was successful!');
        } catch (Exception $exception) {
            consoleOutput()->error("Backup error occurred: {$exception->getMessage()}.");

            event(new BackupHasFailed($exception));

            return -1;
        }
    }

    protected function guardAgainstInvalidOptions()
    {
        if ($this->option('only-db') && $this->option('only-files')) {
            throw InvalidCommand::create('不能一起使用-db和only-files');
        }
    }
}
