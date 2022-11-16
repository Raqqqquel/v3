<?php

namespace App\bdaccess\orm;

use App\bdaccess\orm\DB;
use stdClass;

class QueryBuilder {

    public $set;

    private string $fields = '*';
 
    private string $where = "";
 
    private ?array $params = null;
 
    private string $sql;

    function __construct(private string $table) {
        $this->table = $table;
    }

    public function select(?string $fields = null) { // Seleccionar campos
        $this->fields = (is_null($fields))? '*': $fields;

        return $this;
    }

    public function where( array $where) {
        $field = $where[0];
        if (count($where) == 2){
            $condition = '=';
            $value = $where[1];
        } else {
            $condition = $where[1];
            $value = $where[2];
        }

        $this->where = "WHERE $field $condition: $field";
        $this->params[":$field"] = $value;

        return $this;
    }

     /*public function find(int $id) {
        $where = array('id', '*', $id);
        $this->where($where);

        return $this->getOne();
    }*/
    
    public function find(int $id) {
        $this->where(['id', '=', $id]);
        return $this->getOne();
    }

    public function get():array {
        $this->sql = "SELECT $this->fields FROM $this->table $this->where";
        return DB::select($this->sql, $this->params);
    }

    public function getOne():stdClass {
        $this->sql = "SELECT $this->fields FROM $this->table";
        return DB::selectOne($this->sql, $this->params);
    }

    public function toSql() {
        dd($this->sql);
    }

    // Post
    public function insert(array $data):int { 
        $fieldsParams = "";
        foreach ($data as $key => $value) {
            $fieldsParams .= ":$key,"; //:id,:titulo,:anyo,:duracion,
            $this->params[":$key"] = $value;
        }
        $fieldsParams = rtrim($fieldsParams, ','); //:id,:titulo,:anyo,:duracion
        $fieldsName = implode(",", array_keys($data)); //id, titulo, anyo, duracion
        $this->sql = "INSERT INTO $this->table($fieldsName) VALUES ($fieldsParams)";
        return DB::insert($this->sql, $this->params);
    }
    // Put
    public function update(array $data):int{
        foreach($data as $key=>$value){
            $this->params[":$key"] = $value;
            if ($key != "id"){
                $this->set .= "$key = :$key,";       
            } else {
                $this->where = "$key = :$key";
            }
            
        }
        $this->set = rtrim($this->set,",");
        $this->sql = "UPDATE $this->table SET $this->set WHERE $this->where";
        
        return DB::update($this->sql, $this->params);
    }

    public function delete( $id){
        $this->sql = "DELETE FROM $this->table WHERE id = :id";
        $this->params[":id"] = $id;
        return DB::delete($this->sql, $this->params);
    }
}
