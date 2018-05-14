<?php

class Pagos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="idPago", type="integer", length=11, nullable=false)
     */
    protected $idPago;

    /**
     *
     * @var string
     * @Column(column="pagoAlicuta", type="string", nullable=false)
     */
    protected $pagoAlicuta;

    /**
     *
     * @var string
     * @Column(column="fechaAlicuota", type="string", nullable=false)
     */
    protected $fechaAlicuota;

    /**
     *
     * @var string
     * @Column(column="penalidadAlicuota", type="string", nullable=false)
     */
    protected $penalidadAlicuota;

    /**
     *
     * @var string
     * @Column(column="totalAlicuota", type="string", nullable=false)
     */
    protected $totalAlicuota;

    /**
     *
     * @var integer
     * @Column(column="idDepartamento", type="integer", length=11, nullable=false)
     */
    protected $idDepartamento;

    /**
     * Method to set the value of field idPago
     *
     * @param integer $idPago
     * @return $this
     */
    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;

        return $this;
    }

    /**
     * Method to set the value of field pagoAlicuta
     *
     * @param string $pagoAlicuta
     * @return $this
     */
    public function setPagoAlicuta($pagoAlicuta)
    {
        $this->pagoAlicuta = $pagoAlicuta;

        return $this;
    }

    /**
     * Method to set the value of field fechaAlicuota
     *
     * @param string $fechaAlicuota
     * @return $this
     */
    public function setFechaAlicuota($fechaAlicuota)
    {
        $this->fechaAlicuota = $fechaAlicuota;

        return $this;
    }

    /**
     * Method to set the value of field penalidadAlicuota
     *
     * @param string $penalidadAlicuota
     * @return $this
     */
    public function setPenalidadAlicuota($penalidadAlicuota)
    {
        $this->penalidadAlicuota = $penalidadAlicuota;

        return $this;
    }

    /**
     * Method to set the value of field totalAlicuota
     *
     * @param string $totalAlicuota
     * @return $this
     */
    public function setTotalAlicuota($totalAlicuota)
    {
        $this->totalAlicuota = $totalAlicuota;

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
     * Returns the value of field idPago
     *
     * @return integer
     */
    public function getIdPago()
    {
        return $this->idPago;
    }

    /**
     * Returns the value of field pagoAlicuta
     *
     * @return string
     */
    public function getPagoAlicuta()
    {
        return $this->pagoAlicuta;
    }

    /**
     * Returns the value of field fechaAlicuota
     *
     * @return string
     */
    public function getFechaAlicuota()
    {
        return $this->fechaAlicuota;
    }

    /**
     * Returns the value of field penalidadAlicuota
     *
     * @return string
     */
    public function getPenalidadAlicuota()
    {
        return $this->penalidadAlicuota;
    }

    /**
     * Returns the value of field totalAlicuota
     *
     * @return string
     */
    public function getTotalAlicuota()
    {
        return $this->totalAlicuota;
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
        $this->setSource("pagos");
        $this->belongsTo('idDepartamento', '\Departamentos', 'idDepartamento', ['alias' => 'Departamentos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pagos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pagos[]|Pagos|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pagos|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
