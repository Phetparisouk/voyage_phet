<?php


namespace App\Form\Model;

class ContinentFilterModel
{
    private $continent;

    /**
     * @return mixed
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * @param mixed $continent
     */
    public function setContinent($continent): void
    {
        $this->continent = $continent;
    }
}