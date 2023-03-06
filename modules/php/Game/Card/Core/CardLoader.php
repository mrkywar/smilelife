<?php

namespace SmileLife\Game\Card\Core;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Description of CardLoader
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardLoader {

    private const CARD_BASEPATH = "/Card";

    static public function load() {
        $namespace = substr(dirname(__FILE__), 0, strrpos(dirname(__FILE__), self::CARD_BASEPATH) + strlen(self::CARD_BASEPATH));
        $namespace .= "";

        $dir_iterator = new RecursiveDirectoryIterator(dirname($namespace));
        $iterator = new RecursiveIteratorIterator($dir_iterator);
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                // Ignore any folders, this folder and parent folder
                continue;
            }
            require_once ($file->getPathname());
        }
    }

}
