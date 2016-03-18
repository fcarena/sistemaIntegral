<?php

namespace LaFuente\PrestamoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mate
 *
 * @ORM\Table(name="productos_mates")
 * @ORM\Entity(repositoryClass="LaFuente\PrestamoBundle\Entity\MateRepository")
 */
class Mate extends Product
{

  /**
   * @var string
   *
   * @ORM\Column(name="estado", type="string", length=63)
   */
   protected $estado;


    public function __toString()
    {
        return 'Mate ' . $this->getId();
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Mate
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
