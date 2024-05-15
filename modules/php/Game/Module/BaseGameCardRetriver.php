<?php

namespace SmileLife\Module;

use ReflectionClass;


/**
 * Description of BaseGameCardRetriver
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class BaseGameCardRetriver {

    static public function retrive() {
        $classes = self::retriveClasses();
        $cards = [];
        foreach ($classes as $class) {
            self::generateCard($cards, $class);
        }
        
        return $cards;
    }

    static private function retriveClasses() {

        $firltredClasses = [];
        $declaredClasses = get_declared_classes();

        foreach ($declaredClasses as $class) {
            $reflexion = new ReflectionClass($class);
            if ($reflexion->implementsInterface(BaseGame::class)) {
                $firltredClasses[] = $class;
            }
        }

        return $firltredClasses;
    }

    static private function generateCard(array &$cards, string $class) {
        $object = new $class();

        for ($i = 0; $i < $object->getBaseCardCount(); $i++) {
            $card = new $class();
            $cards[] = $card;
        }

        return $cards;
    }

}
