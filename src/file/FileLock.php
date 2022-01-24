<?php

namespace Sfiolka\SfiolkaLib\File;

class FileLock
{

    private FileSystem $fileSystem;

    private string $path;

    private bool $locked = false;

    public function __construct(FileSystem $fileSystem, string $path)
    {
        $this->fileSystem = $fileSystem;
        $this->path       = $path;
    }

    public function lock(): bool
    {
        if (! $this->locked) {
            if ($this->fileSystem->fileExists($this->path)) {
                return false;
            } else {
                $written = $this->fileSystem->filePutContents($this->path, 'lock');
                if ($written === false) {
                    return false;
                }
            }
        }

        $this->locked = true;

        return true;
    }

    public function unlock()
    {
        if (! $this->locked) {
            return;
        }

        if (! $this->deleteLockFile()) {
            throw new \Exception(sprintf('could not release file lock %s', $this->path));
        }

        $this->locked = false;
    }

    private function deleteLockFile(): bool
    {
        return $this->fileSystem->unlink($this->path);
    }
}