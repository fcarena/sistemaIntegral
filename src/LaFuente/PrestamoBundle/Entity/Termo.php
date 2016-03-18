<?php

namespace LaFuente\PrestamoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Termo
 *
 * @ORM\Table(name="productos_termos")
 * @ORM\Entity(repositoryClass="LaFuente\PrestamoBundle\Entity\TermoRepository")
 */
class Termo extends Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=63)
     */
    protected $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="smallint", unique=true)
     */
    protected $numero;


    public function __toString()
    {
        return 'Termo ' . $this->numero;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Termo
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Termo
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
