<?php

class Datapoints extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(column="label", type="string", length=134, nullable=false)
     */
    protected $label;

    /**
     *
     * @var integer
     * @Column(column="y", type="integer", length=21, nullable=false)
     */
    protected $y;

    /**
     * Method to set the value of field label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Method to set the value of field y
     *
     * @param integer $y
     * @return $this
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Returns the value of field label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Returns the value of field y
     *
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("departamentos");
        $this->setSource("datapoints");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'datapoints';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Datapoints[]|Datapoints|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Datapoints|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
