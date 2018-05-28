<?php

class Mantenimientos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="idMantenimiento", type="integer", length=11, nullable=false)
     */
    protected $idMantenimiento;

    /**
     *
     * @var string
     * @Column(column="nombreMantenimiento", type="string", length=30, nullable=false)
     */
    protected $nombreMantenimiento;

    /**
     *
     * @var string
     * @Column(column="fechaInicio", type="string", nullable=false)
     */
    protected $fechaInicio;

    /**
     *
     * @var string
     * @Column(column="fechaFin", type="string", nullable=false)
     */
    protected $fechaFin;

    /**
     *
     * @var string
     * @Column(column="costoMantenimiento", type="string", nullable=false)
     */
    protected $costoMantenimiento;

    /**
     *
     * @var string
     * @Column(column="memberpic", type="string", nullable=true)
     */
    protected $memberpic;

    /**
     *
     * @var integer
     * @Column(column="votoMantenimiento", type="integer", length=11, nullable=false)
     */
    protected $votoMantenimiento;

    /**
     *
     * @var integer
     * @Column(column="idDepartamento", type="integer", length=11, nullable=false)
     */
    protected $idDepartamento;

    /**
     * Method to set the value of field idMantenimiento
     *
     * @param integer $idMantenimiento
     * @return $this
     */
    public function setIdMantenimiento($idMantenimiento)
    {
        $this->idMantenimiento = $idMantenimiento;

        return $this;
    }

    /**
     * Method to set the value of field nombreMantenimiento
     *
     * @param string $nombreMantenimiento
     * @return $this
     */
    public function setNombreMantenimiento($nombreMantenimiento)
    {
        $this->nombreMantenimiento = $nombreMantenimiento;

        return $this;
    }

    /**
     * Method to set the value of field fechaInicio
     *
     * @param string $fechaInicio
     * @return $this
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Method to set the value of field fechaFin
     *
     * @param string $fechaFin
     * @return $this
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Method to set the value of field costoMantenimiento
     *
     * @param string $costoMantenimiento
     * @return $this
     */
    public function setCostoMantenimiento($costoMantenimiento)
    {
        $this->costoMantenimiento = $costoMantenimiento;

        return $this;
    }

    /**
     * Method to set the value of field memberpic
     *
     * @param string $memberpic
     * @return $this
     */
    public function setMemberpic($memberpic)
    {
        $this->memberpic = $memberpic;

        return $this;
    }

    /**
     * Method to set the value of field votoMantenimiento
     *
     * @param integer $votoMantenimiento
     * @return $this
     */
    public function setVotoMantenimiento($votoMantenimiento)
    {
        $this->votoMantenimiento = $votoMantenimiento;

        return $this;
    }

    /**
     * Method to set the value of field idDepartamento
     *
     * @param integer $idDepartamento
     * @return $this
     */
    public function setIdDepartamento($idDepartamento)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * Returns the value of field idMantenimiento
     *
     * @return integer
     */
    public function getIdMantenimiento()
    {
        return $this->idMantenimiento;
    }

    /**
     * Returns the value of field nombreMantenimiento
     *
     * @return string
     */
    public function getNombreMantenimiento()
    {
        return $this->nombreMantenimiento;
    }

    /**
     * Returns the value of field fechaInicio
     *
     * @return string
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Returns the value of field fechaFin
     *
     * @return string
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Returns the value of field costoMantenimiento
     *
     * @return string
     */
    public function getCostoMantenimiento()
    {
        return $this->costoMantenimiento;
    }

    /**
     * Returns the value of field memberpic
     *
     * @return string
     */
    public function getMemberpic()
    {
        return $this->memberpic;
    }

    /**
     * Returns the value of field votoMantenimiento
     *
     * @return integer
     */
    public function getVotoMantenimiento()
    {
        return $this->votoMantenimiento;
    }

    /**
     * Returns the value of field idDepartamento
     *
     * @return integer
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("departamentos");
        $this->setSource("mantenimientos");
        $this->belongsTo('idDepartamento', '\Departamentos', 'idDepartamento', ['alias' => 'Departamentos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mantenimientos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mantenimientos[]|Mantenimientos|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mantenimientos|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
