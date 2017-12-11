<?php

namespace Backup;

/**
 * Запускатель backup
 */
class Runner
{
    public function __construct(array $params)
    {
        $this->params = $params;

    }

    public function backup()
    {
        $this->calcDestinationPath();
        $this->copyAl();
        $this->calcSourcePath();
        $this->rsync();
        $this->removeWastedCopy();
    }

    private function calcDestinationPath()
    {

    }

    private function calcSourcePath()
    {
        $this->sourcePath = $this->params['project_path'];
        return $this->sourcePath;
    }

    private function calcLastPath()
    {
        return '2017-12-07';
    }

    private function getAllFolders()
    {
        return '2017-12-07';
    }

    private function getPath($filename)
    {
        if ($this->params['project_path'][0] == '~') {
            return '.' . substr($this->params['project_path'], 1) . '/' . $filename;
        }
        return $this->params['project_path'] . '/' . $filename;
    }
    private function rsync()
    {
        $rsyncCommand = $this->getRsyncCommand();
        // echo 'Rsync started', PHP_EOL;
        // echo $rsyncCommand, PHP_EOL;
        shell_exec($rsyncCommand);
    }

    private function getRsyncCommand()
    {
        $prefix = (empty($this->params['password']))
            ? ''
            : 'sshpass -p ' . $this->params['password'] . ' ';

        return $prefix . 'rsync -aLz --delete-after --exclude-from exclude.txt -e "ssh -p '
            . $this->params['port'] . '" '
            . $this->params['user'] . '@'
            . $this->params['host'] . ':'
            . $this->params['project_path'] . '/ '
            . $this->params['backup_path'] . '/'
            . $this->params['project_name'];
    }
}