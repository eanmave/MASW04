<?php

class Serie{

    private $id;
    private $title;
    private $platform;
    private $director;
    private $actors;
    private $audioLanguages;
    private $subtitleLanguages;

    /**
     * @param $id
     * @param $title
     * @param $platform
     * @param $director
     * @param $actors
     * @param $audioLanguages
     * @param $subtitleLanguages
     */
    public function __construct($id, $title, $platform, $director, $actors, $audioLanguages, $subtitleLanguages)
    {
        $this->id = $id;
        $this->title = $title;
        $this->platform = $platform;
        $this->director = $director;
        $this->actors = $actors;
        $this->audioLanguages = $audioLanguages;
        $this->subtitleLanguages = $subtitleLanguages;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param mixed $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param mixed $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;
    }

    /**
     * @return mixed
     */
    public function getAudioLanguages()
    {
        return $this->audioLanguages;
    }

    /**
     * @param mixed $audioLanguages
     */
    public function setAudioLanguages($audioLanguages)
    {
        $this->audioLanguages = $audioLanguages;
    }

    /**
     * @return mixed
     */
    public function getSubtitleLanguages()
    {
        return $this->subtitleLanguages;
    }

    /**
     * @param mixed $subtitleLanguages
     */
    public function setSubtitleLanguages($subtitleLanguages)
    {
        $this->subtitleLanguages = $subtitleLanguages;
    }


}
