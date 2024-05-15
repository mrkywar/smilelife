<?php

namespace SmileLife\Card\Core;

use Core\ClassLoader\RecursiveDirectoryClassesLoader;

/**
 * Description of CardLoader
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardLoader extends RecursiveDirectoryClassesLoader {

    private const CARD_BASEPATH = "/Card";

    protected function getNamespace(): string {
        $namespace = substr(dirname(__FILE__), 0, strrpos(dirname(__FILE__), self::CARD_BASEPATH) + strlen(self::CARD_BASEPATH));

        return $namespace;
    }
}
