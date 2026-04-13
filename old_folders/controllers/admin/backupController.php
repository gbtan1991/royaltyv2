<?php

class BackupController
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'royalty_db'; // Change this to your actual database name
    private $backupDir;

    public function __construct()
    {
        // Set the path for the backup folder
        $this->backupDir = realpath(__DIR__ . '/../../backups');

        // If it doesn't exist, create it
        if (!$this->backupDir) {
            $this->backupDir = __DIR__ . '/../../backups';
            if (!is_dir($this->backupDir)) {
                mkdir($this->backupDir, 0755, true);
            }
        }
    }

    public function createBackup()
    {
        $date = date('Ymd_His');
        $backupFile = "{$this->backupDir}/db_backup_{$date}.sql";

        // Build the command
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            escapeshellarg($this->username),
            escapeshellarg($this->password),
            escapeshellarg($this->host),
            escapeshellarg($this->database),
            escapeshellarg($backupFile)
        );

        // Execute the backup command
        $output = null;
        $resultCode = null;
        exec($command, $output, $resultCode);

        if ($resultCode === 0) {
            echo "<p style='color: green;'>✅ Database backup created successfully.</p>";
            echo "<p>Saved to: <code>{$backupFile}</code></p>";
        } else {
            echo "<p style='color: red;'>❌ Backup failed. Please check your credentials or server permissions.</p>";
        }
    }
}
