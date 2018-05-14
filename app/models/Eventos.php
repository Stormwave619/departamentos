<?php

class Eventos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="idEvento", type="integer", length=11, nullable=false)
     */
    protected $idEvento;

    /**
     *
     * @var string
     * @Column(column="nombreEvento", type="string", length=30, nullable=false)
     */
    protected $nombreEvento;

    /**
     *
     * @var string
     * @Column(column="horaInicio", type="string", nullable=false)
     */
    protected $horaInicio;

    /**
     *
     * @var string
     * @Column(column="horaFin", type="string", nullable=false)
     */
    protected $horaFin;

    /**
     *
     * @var string
     * @Column(column="fechaEvento", type="string", nullable=false)
     */
    protected $fechaEvento;

    /**
     *
     * @var integer
     * @Column(column="idDepartamento", type="integer", length=11, nullable=false)
     */
    protected $idDepartamento;

    /**
     * Method to set the value of field idEvento
     *
     * @param integer $idEvento
     * @return $this
     */
    public function setIdEvento($idEvento)
    {
        $this->idEvento = $idEvento;

        return $this;
    }

    /**
     * Method to set the value of field nombreEvento
     *
     * @param string $nombreEvento
     * @return $this
     */
    public function setNombreEvento($nombreEvento)
    {
        $this->nombreEvento = $nombreEvento;

        return $this;
    }

    /**
     * Method to set the value of field horaInicio
     *
     * @param string $horaInicio
     * @return $this
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Method to set the value of field horaFin
     *
     * @param string $horaFin
     * @return $this
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Method to set the value of field fechaEvento
     *
     * @param string $fechaEvento
     * @return $this
     */
    public function setFechaEvento($fechaEvento)
    {
        $this->fechaEvento = $fechaEvento;

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
     * Returns the value of field idEvento
     *
     * @return integer
     */
    public function getIdEvento()
    {
        return $this->idEvento;
    }

    /**
     * Returns the value of field nombreEvento
     *
     * @return string
     */
    public function getNombreEvento()
    {
        return $this->nombreEvento;
    }

    /**
     * Returns the value of field horaInicio
     *
     * @return string
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Returns the value of field horaFin
     *
     * @return string
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Returns the value of field fechaEvento
     *
     * @return string
     */
    public function getFechaEvento()
    {
        return $this->fechaEvento;
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
        $this->setSource("eventos");
        $this->belongsTo('idDepartamento', '\Departamentos', 'idDepartamento', ['alias' => 'Departamentos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'eventos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Eventos[]|Eventos|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Eventos|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
