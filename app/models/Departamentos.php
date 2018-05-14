<?php

class Departamentos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="idDepartamento", type="integer", length=11, nullable=false)
     */
    protected $idDepartamento;

    /**
     *
     * @var integer
     * @Column(column="numeroDepartamento", type="integer", length=100, nullable=false)
     */
    protected $numeroDepartamento;

    /**
     *
     * @var integer
     * @Column(column="numeroTelefono", type="integer", length=9, nullable=false)
     */
    protected $numeroTelefono;

    /**
     *
     * @var integer
     * @Column(column="idUsuario", type="integer", length=11, nullable=false)
     */
    protected $idUsuario;

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
     * Method to set the value of field numeroDepartamento
     *
     * @param integer $numeroDepartamento
     * @return $this
     */
    public function setNumeroDepartamento($numeroDepartamento)
    {
        $this->numeroDepartamento = $numeroDepartamento;

        return $this;
    }

    /**
     * Method to set the value of field numeroTelefono
     *
     * @param integer $numeroTelefono
     * @return $this
     */
    public function setNumeroTelefono($numeroTelefono)
    {
        $this->numeroTelefono = $numeroTelefono;

        return $this;
    }

    /**
     * Method to set the value of field idUsuario
     *
     * @param integer $idUsuario
     * @return $this
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
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
     * Returns the value of field numeroDepartamento
     *
     * @return integer
     */
    public function getNumeroDepartamento()
    {
        return $this->numeroDepartamento;
    }

    /**
     * Returns the value of field numeroTelefono
     *
     * @return integer
     */
    public function getNumeroTelefono()
    {
        return $this->numeroTelefono;
    }

    /**
     * Returns the value of field idUsuario
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("departamentos");
        $this->setSource("departamentos");
        $this->belongsTo('idUsuario', '\Login', 'id', ['alias' => 'Login']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'departamentos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Departamentos[]|Departamentos|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Departamentos|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
	
	


}
