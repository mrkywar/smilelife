<?php

namespace Core\Serializers;

use Core\Models\Core\Model;
use Core\Serializers\Core\SerializerException;
use Core\DB\Fields\DBField;
use Core\DB\Fields\DBFieldsRetriver;

/**
 * Description of Serializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Serializer {

    /**
     * @var string
     */
    private $classModel;

    /**
     * @var bool
     */
    private $isForcedArray = false;

    public function __construct(string $classModel = null) {
        $this->classModel = $classModel;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Serialize & Tools
     * ---------------------------------------------------------------------- */

    /**
     * allow transform Model to Array (DBCompatible)
     * @param array<Model>|Model $items Model(s) to transform
     * @return array
     */
    public function serialize($items, array $fields = null) {
        if (null === $fields) {
            $fields = DBFieldsRetriver::retrive($items);
        }

        if (is_array($items)) {
            $results = [];
            foreach ($items as $key => $item) {
                $results[] = $this->serializeOnce($item, $fields, $key);
            }
            return $results;
        } else {
            return $this->serializeOnce($items, $fields);
        }
    }

    private function serializeOnce(Model $item, $fields, $key = null) {
        $rawData = [];
        foreach ($fields as $field) {
            $getter = "get" . ucfirst($field->getProperty());
            $rawData[$field->getDbName()] = $item->$getter();
        }
        return $rawData;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Unserialize & Tools
     * ---------------------------------------------------------------------- */

    /**
     * allow transform Array (DBCompatible) to Model
     * @param $rawItems to transform
     * @return array<Model>|Model 
     */
    public function unserialize($rawItems) {
        $classModel = $this->classModel;
        if (null === $classModel) {
            throw new SerializerException("No class Model defined");
        } elseif (!is_array($rawItems)) {
            throw new SerializerException("Array expected");
        }
        $fields = DBFieldsRetriver::retrive($classModel);

        if (1 === sizeof($rawItems) && !$this->isForcedArray) {
            return $this->unserializeOnce($rawItems[array_keys($rawItems)[0]], $fields);
        } elseif (is_array($rawItems)) {
            $items = [];
            foreach ($rawItems as $key => $rawItem) {
                $model = $this->unserializeOnce($rawItem, $fields);
                if (null === $model->getId()) {
                    $model->setId($key);
                }
                $items[] = $model;
            }
            return $items;
        }
        return;
    }

    /**
     * 
     * @param type $rawItem
     * @return Model
     */
    protected function generateNewModel($rawItem): Model {
        $modelStr = $this->classModel;
        return new $modelStr();
    }

    /**
     * Allow you Data To Object transform
     * @param array $rawItem : Raw item to transform
     * @param array<DBField> $fields : Field to use for unserialization
     * @return Model
     */
    private function unserializeOnce($rawItem, $fields) {
        if($rawItem instanceof Model){
            return $rawItem; //serialization is already done
        }
        $model = $this->generateNewModel($rawItem);
        
        foreach ($fields as $field) {
            if (isset($rawItem[$field->getDbName()])) {
                $setter = "set" . ucfirst($field->getProperty());
                $model->$setter($this->parseRawValue($field, $rawItem[$field->getDbName()]));
            }
        }

        return $model;
    }

    private function parseRawValue(DBField $field, $value) {
        //switch ($field->getT)
        switch ($field->getType()) {
            case DBField::DATETIME_FORMAT:
                return \DateTime::createFromFormat(DBField::DATETIME_STRING_FORMAT, $value);
            case DBField::BOOLEAN_FORMAT:
                return 1 === $value;
            case DBField::JSON_FORMAT:
//                var_dump($value,json_decode($value));
                return json_decode($value, true);
            default:
                return $value;
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getClassModel(): string {
        return $this->classModel;
    }

    public function setClassModel(string $classModel) {
        $this->classModel = $classModel;
        return $this;
    }

    public function getIsForcedArray(): bool {
        return $this->isForcedArray;
    }

    public function setIsForcedArray(bool $isForcedArray) {
        $this->isForcedArray = $isForcedArray;
        return $this;
    }

}
