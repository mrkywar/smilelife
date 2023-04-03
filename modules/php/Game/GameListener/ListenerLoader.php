<?php

namespace SmileLife\Game\GameListener;

use Core\ClassLoader\RecursiveDirectoryClassesLoader;

/**
 * Description of ListenerLoader
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ListenerLoader extends RecursiveDirectoryClassesLoader{
   private const CARD_BASEPATH = "/";

    protected function getNamespace(): string {
        $namespace = substr(dirname(__FILE__), 0, strrpos(dirname(__FILE__), self::CARD_BASEPATH) + strlen(self::CARD_BASEPATH));
//        $namespace .= self::CARD_CATEGORY_PATH;

        return $namespace;
    }
}
