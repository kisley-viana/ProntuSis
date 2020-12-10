<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    protected $connection = 'mysql';
    protected $table = 'prontuario';
    protected $primarykey = 'id';
   // protected $primarykey = 'cns';
    public $timestamps = false;

    public static $id = "id";
    public static $cns = "cns";
    public static $nomecompleto = "nomecompleto";
    public static $sexo = "sexo";
    public static $estante = "estante";
    public static $letra = "letra";
    public static $armazenado = "armazenado";

    //Getters
    public function getId(){ return $this->attributes[Prontuario::$id]; }
    public function getCns(){ return $this->attributes[Prontuario::$cns]; }
    public function getNomecompleto() { return $this->attributes[Prontuario::$nomecompleto]; }
    public function getSexo(){ return $this->attributes[Prontuario::$sexo]; }
    public function getEstante(){ return $this->attributes[Prontuario::$estante]; }
    public function getLetra(){ return $this->attributes[Prontuario::$letra]; }
    public function getArmazenado(){ return $this->attributes[Prontuario::$armazenado]; }

    //Setters
    //public function setId($valor){ return $this->attributes[Prontuario::$id] = $valor; }
    public function setCns($valor){ return $this->attributes[Prontuario::$cns] = $valor; }
    public function setNomecompleto($valor){ return $this->attributes[Prontuario::$nomecompleto] = $valor; }
    public function setSexo($valor){ return $this->attributes[Prontuario::$sexo] = $valor; }
    public function setEstante($valor){ return $this->attributes[Prontuario::$estante] = $valor; }
    public function setLetra($valor){ return $this->attributes[Prontuario::$letra] = $valor; }
    public function setArmazenado($valor){ return $this->attributes[Prontuario::$armazenado] = $valor; }

}
