<?php

namespace Core\ClassLoader;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Description of RecursiveDirectoryClassesLoader
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class RecursiveDirectoryClassesLoader {

    abstract protected function getNamespace(): string;

    public function load() {
        foreach (self::getFilesList($this->getNamespace()) as $file) {
            require_once ($file->getPathname());
        }
    }

    public function getFilesList($namespace) {
        $files = [];

        $dir_iterator = new RecursiveDirectoryIterator($namespace);
        $iterator = new RecursiveIteratorIterator($dir_iterator);
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                // Ignore any folders, this folder and parent folder
                continue;
            }
            $files[] = $file;
        }
        return $files;
    }

}
