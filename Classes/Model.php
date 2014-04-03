<?php

/*

This script is licensed under Apache 2.0. View the license here:
http://www.apache.org/licenses/LICENSE-2.0.html
Copyright Reserved to g0g0l
Contact @ Skype : noc2spam
*/


class Model extends Utility {

    public $tableName = null;
    public $db = null;
    public $attributes = array();

    function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insert() {
        $db = $this->db;
        $attributes = $this->attributes;
        if (!is_array($attributes) || empty($attributes)) {
            throw new Exception("Attributes not set.");
            return false;
        }
        $db->beginTransaction();
        $insertValues = array();
        $questionMarks = array();
        if ($this->isMultiArray($attributes)) {
            // multiple rows insert situation
            $dataFields = array_keys($attributes[0]);
            foreach ($attributes as $attribute) {
                $questionMarks[] = '(' . $this->placeHolders('?', sizeof($attribute)) . ')';
                $insertValues = array_merge($insertValues, array_values($attribute));
            }
        } else {
            // single row insert situation
            $dataFields = array_keys($attributes);
            $questionMarks[] = '(' . $this->placeHolders('?', sizeof($attributes)) . ')';
            $insertValues = array_values($attributes);
        }

        $sql = 'INSERT INTO ' . $this->tableName . ' (' . implode(',', $dataFields) . ') '
                . 'VALUES ' . implode(',', $questionMarks);

        try {
            $query = $db->prepare($sql);
            $return = $query->execute($insertValues);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        $db->commit();
    }

    public function update() {
        
    }

}
