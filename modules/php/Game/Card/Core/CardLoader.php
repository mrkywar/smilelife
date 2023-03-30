<?php

namespace SmileLife\Card\Core;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Description of CardLoader
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardLoader {

    private const CARD_BASEPATH = "/Card";
    private const CARD_CATEGORY_PATH = "/Category";

    static public function load() {
        $namespace = substr(dirname(__FILE__), 0, strrpos(dirname(__FILE__), self::CARD_BASEPATH) + strlen(self::CARD_BASEPATH));
        $namespace .= self::CARD_CATEGORY_PATH;

        foreach (self::getFilesList($namespace) as $file) {
            require_once ($file->getPathname());
        }
    }

    static public function getFilesList($namespace) {
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
