<?php

class Language{

    private $id;
    private $name;
    private $isoCode;

    /**
     * @param $id
     * @param $name
     * @param $isoCode
     */
    public function __construct($id, $name, $isoCode)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isoCode = $isoCode;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * @param mixed $isoCode
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;
    }

}