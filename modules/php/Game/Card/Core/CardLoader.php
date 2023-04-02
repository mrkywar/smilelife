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
    private const CARD_CATEGORY_PATH = "/Category";

    public function getNamespace(): string {
        $namespace = substr(dirname(__FILE__), 0, strrpos(dirname(__FILE__), self::CARD_BASEPATH) + strlen(self::CARD_BASEPATH));
        $namespace .= self::CARD_CATEGORY_PATH;

        return $namespace;
    }

}
