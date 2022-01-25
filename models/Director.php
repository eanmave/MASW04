<?php

class Director{
    private $id;
    private $givenName;
    private $surnames;
    private $birthDate;
    private $country;

    /**
     * @param $id
     * @param $givenName
     * @param $surnames
     * @param $birthDate
     * @param $country
     */
    public function __construct($id, $givenName, $surnames, $birthDate, $country)
    {
        $this->id = $id;
        $this->givenName = $givenName;
        $this->surnames = $surnames;
        $this->birthDate = $birthDate;
        $this->country = $country;
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
    public function getGivenName()
    {
        return $this->givenName;
    }

    /**
     * @param mixed $givenName
     */
    public function setGivenName($givenName)
    {
        $this->givenName = $givenName;
    }

    /**
     * @return mixed
     */
    public function getSurnames()
    {
        return $this->surnames;
    }

    /**
     * @param mixed $surnames
     */
    public function setSurnames($surnames)
    {
        $this->surnames = $surnames;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }


    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->getGivenName()." ".$this->getSurnames();
    }
}