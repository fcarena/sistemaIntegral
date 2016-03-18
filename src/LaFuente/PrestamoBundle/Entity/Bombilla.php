<?php

namespace LaFuente\PrestamoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bombilla
 *
 * @ORM\Table(name="productos_bombilla")
 * @ORM\Entity(repositoryClass="LaFuente\PrestamoBundle\Entity\BombillaRepository")
 */
class Bombilla extends Product
{

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=63)
     */
    protected $estado;


    public function __toString()
    {
        return 'Bombilla ' . $this->getId();
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Bombilla
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
