<?php

namespace Core\ClassLoader;

/**
 * Description of RecursiveDirectoryClassesLoader
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class RecursiveDirectoryClassesLoader {

    abstract public function getNamespace(): string;

    public function load() {
        foreach (self::getFilesList($this->getNamespace()) as $file) {
            require_once ($file->getPathname());
        }
    }

    protected function getFilesList($namespace) {
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
        ;
    }

}
