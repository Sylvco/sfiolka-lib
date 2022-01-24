<?php

namespace Sfiolka\SfiolkaLib\File;

class FileSystem
{
    /**
     * @const string
     */
    const TEMP_DIR_PATH = '/tmp';

    public function fileExists(string $path): bool {
        return file_exists($path);
    }

    public function isFile(string $path): bool {
        return is_file($path);
    }

    public function isDir(string $path): bool {
        return is_dir($path);
    }

    public function rename(string $from, string $to): bool {
        return rename($from, $to);
    }

    public function copy(string $source, string $destination): bool {
        return copy($source, $destination);
    }

    public function basename(string $path): string {
        return basename($path);
    }

    public function createDirectory(string $path, $mode = 0777, bool $recursive = true) {
        if (! $this->fileExists($path)) {
            $umask   = umask(0);
            $created = mkdir($path, $mode, $recursive);
            umask($umask);

            if (! $created) {
                throw new \Exception(
                    sprintf(
                        '%s directory could not be created',
                        $path
                    )
                );
            }
        }
    }

    public function tempDirPath(): string {
        return self::TEMP_DIR_PATH;
    }

    /**
     * @param string $path
     * @param string $content
     *
     * @return false|int
     */
    public function filePutContents(string $path, string $content)
    {
        return file_put_contents($path, $content);
    }

    public function unlink(string $path): bool {
        return unlink($path);
    }

    public function touch(string $outputFilePath): bool {
        return touch($outputFilePath);
    }

    public function fileMTime(string $filePath): ?int {
        return filemtime($filePath);
    }

    public function fileIsOlderThanSeconds(string $filePath, int $numberOfSeconds): bool {
        if (! $this->fileExists($filePath)) {
            return false;
        }

        $fileModificationTime = $this->fileMTime($filePath);

        if ($fileModificationTime === null) {
            return false;
        }

        return time() - $fileModificationTime > $numberOfSeconds;
    }
}