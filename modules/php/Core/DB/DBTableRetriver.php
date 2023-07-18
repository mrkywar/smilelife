<?php

namespace Core\DB;

use Core\Models\Core\Model;
use Core\DB\Exceptions\DBTableRetriverException;
use ReflectionClass;

/**
 * Description of DBTableRetriver
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DBTableRetriver {

    private const PROPERTY_TABLE = "@ORM\Table";

    /**
     * Allows you to determine the name of the table used
     * @param type $item
     * @return DBTable
     */
    public static function retrive($item) {
        if (is_array($item)) {     
            return self::retrive($item[array_keys($item)[0]]);
        } elseif ($item instanceof Model) {
            return self::retriveFromClassName(get_class($item));
        } else {
            throw new DBTableRetriverException("Unsupported call for : " . $item . " - ERROR CODE : DBTR-01");
        }
    }

    public static function retriveFromClassName($classname) {
        $reflexion = new ReflectionClass($classname);
        $strpos = strpos($reflexion->getDocComment(), self::PROPERTY_TABLE);
        if ($strpos < 0) {
            return;
        }
        $strpos += strlen(self::PROPERTY_TABLE);

        $chaine = substr($reflexion->getDocComment(), $strpos);
        $jsonStr = substr($chaine, 0, strpos($chaine, "}") + 1);
        $obj = json_decode($jsonStr);
        //support Inheritance
        if (!is_object($obj)) {
            return self::retriveFromClassName(get_parent_class($classname));
        } 

        $table = new DBTable();
        $table->setName($obj->name);
        return $table;
    }

}
