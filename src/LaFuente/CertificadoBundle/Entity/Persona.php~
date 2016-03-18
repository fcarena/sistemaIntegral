<?php

namespace LaFuente\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="Persona")
 * @ORM\Entity
 */
class Persona
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
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=255, nullable=true)
     */
    private $dni; 
       
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;
       
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique = true)
     */
    private $email;

    /**
     * @var \LaFuente\CertificadoBundle\Entity\TipoRolPersona
     *
     * @ORM\ManyToOne(targetEntity="\LaFuente\CertificadoBundle\Entity\TipoRolPersona")
     * * @ORM\JoinColumn(name="tipoRolPersona", referencedColumnName="id", nullable=false)
     */
    private $tipoRolPersona;


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
     * Set dni
     *
     * @param string $dni
     *
     * @return Persona
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Persona
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

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Persona
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set TipoRolPersona
     *
     * @param \LaFuente\CertificadoBundle\Entity\TipoRolPersona $tipoRolPersona
     * @return Persona
     */
    public function setTipoRolPersona(\LaFuente\CertificadoBundle\Entity\TipoRolPersona $tipoRolPersona)
    {
        $this->tipoRolPersona = $tipoRolPersona;

        return $this;
    }

    /**
     * Get TipoRolPersona
     *
     * @return \LaFuente\CertificadoBundle\Entity\TipoRolPersona
     */
    public function getTipoRolPersona()
    {
        return $this->tipoRolPersona;
    }
    
    public function __toString() {
        return $this->getNombre();
    }
}
