<?php

namespace Spatie\Backup\Commands;

use Exception;
use Spatie\Backup\Events\CleanupHasFailed;
use Spatie\Backup\Tasks\Cleanup\CleanupJob;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;

class CleanupCommand extends BaseCommand
{
    /**
     * @var string
     */
    protected $signature = 'backup:clean';

    /**
     * @var string
     */
    protected $description = '删除配置中超过指定天数的所有备份.';

    public function handle()
    {
        consoleOutput()->comment('开始清理......');

        try {
            $config = config('laravel-backup');

            $backupDestinations = BackupDestinationFactory::createFromArray($config['backup']);

            $strategy = app($config['cleanup']['strategy']);

            $cleanupJob = new CleanupJob($backupDestinations, $strategy);

            $cleanupJob->run();

            consoleOutput()->comment('清理完成！');
        } catch (Exception $exception) {
            event(new CleanupHasFailed($exception));

            return -1;
        }
    }
}
