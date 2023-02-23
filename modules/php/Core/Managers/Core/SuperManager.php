<?php

namespace Core\Managers\Core;

use Core\DB\DBRequester;
use Core\DB\DBTableRetriver;
use Core\DB\DBValueRetriver;
use Core\DB\Fields\DBFieldsRetriver;
use Core\DB\QueryBuilder;
use Core\Models\Core\Model;
use Core\Serializers\Serializer;
use ReflectionClass;

/**
 * Description of SuperManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class SuperManager extends DBRequester {

    /**
     * 
     * @var Serializer
     */
    private $serializer;

    /**
     * 
     * @var bool
     */
    private $useSerializerClass = false;

    /* -------------------------------------------------------------------------
     *                  BEGIN - SERIALIZER
     * ---------------------------------------------------------------------- */

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer {
        if (null === $this->serializer) {
            $this->serializer = $this->initSerializer();
        }
        return $this->serializer;
    }

    public function setUseSerializerClass(bool $useSerializerClass) {
        $this->useSerializerClass = $useSerializerClass;
        return $this;
    }

    public function getUseSerializerClass(): bool {
        return $this->useSerializerClass;
    }

    /**
     * @return Serializer
     */
    abstract protected function initSerializer();

    /* -------------------------------------------------------------------------
     *                  BEGIN - Fields Retrive Methods (protected/private)
     * ---------------------------------------------------------------------- */

    final private function getItems($items = null) {
        if (null === $items) {
            $className = $this->getSerializer()->getClassModel();
            $reflection = new ReflectionClass($className);

            if (!$reflection->isAbstract()) {
                return new $className();
            } else {
                throw new SuperManagerException("Unsuported call for - ERROR code : SM-02 ");
            }
        }
    }

    final protected function getInsertFields($items) {
        if (true === $this->getUseSerializerClass()) {
            return DBFieldsRetriver::retriveInsertFieldsFormClassName($this->getSerializer()->getClassModel());
        }
        return DBFieldsRetriver::retriveInsertFields($items);
    }

    final protected function getSelectFields() {
//        var_dump(DBFieldsRetriver::retrive($this->getSerializer()->getClassModel()));
//        die('Sel');
        return DBFieldsRetriver::retriveSelectFields($this->getSerializer()->getClassModel());
    }

    final protected function getPrimaryFields($items) {
        return DBFieldsRetriver::retrivePrimaryFields($items);
    }

    final protected function getUpdateFields($items) {
        return DBFieldsRetriver::retriveUpdatableFields($items);
    }

    final protected function getFieldByProperty(string $propertyName, $items = null) {
        return DBFieldsRetriver::retriveFieldByPropertyName($propertyName, $this->getItems($items));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Table Retrive Methods (protected)
     * ---------------------------------------------------------------------- */

    final protected function getTable($items = null) {
        if (null === $items) {
            $className = $this->getSerializer()->getClassModel();
            return DBTableRetriver::retriveFromClassName($className);

//            var_dump($className);die;
//            $items = new $className();
        }
        return DBTableRetriver::retrive($items);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Generic methods
     * ---------------------------------------------------------------------- */

    protected function create($items) {
        $fields = $this->getInsertFields($items);
        $table = $this->getTable($items);

        $qb = new QueryBuilder();
        $qb->setTable($table)
                ->insert()
                ->setFields($fields);
        if ($items instanceof Model) {
            $qb->addValue($items);
        } else {
            $qb->setValues($items);
        }

        return $this->execute($qb);
    }

    protected function update($items) {
        if ($items instanceof Model) {
            $table = $this->getTable($items);
            $primaries = $this->getPrimaryFields($items);
            $udpatables = $this->getUpdateFields($items);

            $qb = new QueryBuilder();
            $qb->update()
                    ->setTable($table);
            foreach ($udpatables as $udpatable) {
                $qb->addSetter($udpatable, DBValueRetriver::retrive($udpatable, $items));
            }
            foreach ($primaries as $primary) {
                $qb->addClause($primary, DBValueRetriver::retrive($primary, $items));
            }

            $this->execute($qb);
        } elseif (is_array($items)) {
            foreach ($items as $item) {
                $this->update($item);
            }
        } else {
            throw new SuperManagerException("Unsuported Update call for " . get_class($items) . " - ERROR code : SM-01 ");
        }
        return $this;
    }

    /**
     * 
     * @param type $clauses
     * @param type $limit
     * @return QueryBuilder
     */
    protected function prepareFindBy($clauses = [], $limit = null, $orderBy = []) {
        $fields = $this->getSelectFields();
        $table = $this->getTable();

        $qb = new QueryBuilder();

        $qb->setTable($table)
                ->select()
                ->setFields($fields);
        foreach ($clauses as $clause => $value) {
            $field = DBFieldsRetriver::retriveFieldByPropertyName($clause, $this->getSerializer()->getClassModel());
            $qb->addClause($field, $value);
        }
        if (null !== $limit) {
            $qb->setLimit($limit);
        }

        return $qb;
    }

    /**
     * @return QueryBuilder
     */
    protected function prepareUpdate($items = null) {
        $table = $this->getTable($items);
        $primaries = $this->getPrimaryFields($items);
//        $udpatables = $this->getUpdateFields($items);

        $qb = new QueryBuilder();
        $qb->update()
                ->setTable($table);

        foreach ($primaries as $primary) {
            $qb->addClause($primary, DBValueRetriver::retrive($primary, $items));
        }

        return $qb;
    }

    public function findBy($clauses = [], $limit = null, $orderBy = []) {
        $qb = $this->prepareFindBy($clauses, $limit, $orderBy);
        $rawResults = $this->execute($qb);
        return $this->getSerializer()->unserialize($rawResults);
    }

}
