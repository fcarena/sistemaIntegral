<?php

namespace LaFuente\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoRolPersona
 *
 * @ORM\Table(name="TipoRolPersona")
 * @ORM\Entity
 */
class TipoRolPersona
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text
     *
     * @ORM\Column(name="nombre", type="text", length=255, nullable=false)
     */
    private $nombre;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoRolPersona
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    public function __toString() {
        return $this->getNombre();
    }
}
