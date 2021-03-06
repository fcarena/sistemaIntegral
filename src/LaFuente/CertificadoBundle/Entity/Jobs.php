<?php

namespace LaFuente\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jobs
 *
 * @ORM\Table(name="Jobs")
 * @ORM\Entity
 */
class Jobs
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
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;  

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text", nullable=false)
     */
    private $cuerpo; 
       
    /**
     * @var boolean
     *
     * @ORM\Column(name="terminado", type="boolean", nullable=false)
     */
    private $terminado;

    /**
     * @var \LaFuente\CertificadoBundle\Entity\TipoCertificado
     *
     * @ORM\ManyToOne(targetEntity="\LaFuente\CertificadoBundle\Entity\TipoCertificado")
     * * @ORM\JoinColumn(name="tipoCertificado", referencedColumnName="id", nullable=false)
     */
    private $tipoCertificado;    

    /**
     * @ORM\ManyToMany(targetEntity="Firmante", inversedBy="firmantes")
     * @ORM\JoinTable(name="jobs_firmantes")
     */
    private $firmantes;

    /**
     * @ORM\ManyToMany(targetEntity="Persona", inversedBy="personas")
     * @ORM\JoinTable(name="jobs_personas")
     */
    private $personas;

   /**
     * Constructor
     */
    public function __construct()
    {
        $this->firmantes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->personas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add firmante
     *
     * @param \LaFuente\CertificadoBundle\Entity\Firmante $firmante
     *
     * @return Jobs
     */
    public function addFirmante( \LaFuente\CertificadoBundle\Entity\Firmante $firmante)
    {
        $this->firmantes[] = $firmante;

        return $this;
    }

    /**
     * Remove firmante
     *
     * @param  \LaFuente\CertificadoBundle\Entity\Firmante $firmante
     */
    public function removeFirmante( \LaFuente\CertificadoBundle\Entity\Firmante $firmante)
    {
        $this->firmantes->removeElement($firmante);
    }

    /**
     * Get firmantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFirmantes()
    {
        return $this->firmantes;
    }

    /**
     * Add persona
     *
     * @param \LaFuente\CertificadoBundle\Entity\Persona $persona   *
     * @return Jobs
     */
    public function addPersona( \LaFuente\CertificadoBundle\Entity\Persona $persona)
    {
        $this->personas[] = $persona;

        return $this;
    }

    /**
     * Remove persona
     *
     * @param  \LaFuente\CertificadoBundle\Entity\Persona $persona
     */
    public function removePersona( \LaFuente\CertificadoBundle\Entity\Persona $persona)
    {
        $this->personas->removeElement($persona);
    }

    /**
     * Get personas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonas()
    {
        return $this->personas;
    }

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
     * Set tipoCertificado
     *
     * @param \LaFuente\CertificadoBundle\Entity\TipoCertificado $tipoCertificado
     * @return Persona
     */
    public function setTipoCertificado(\LaFuente\CertificadoBundle\Entity\TipoCertificado $tipoCertificado)
    {
        $this->tipoCertificado = $tipoCertificado;

        return $this;
    }

    /**
     * Get tipoCertificado
     *
     * @return \LaFuente\CertificadoBundle\Entity\TipoCertificado
     */
    public function getTipoCertificado()
    {
        return $this->tipoCertificado;
    }
    


    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Jobs
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     *
     * @return Jobs
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    /**
     * Set terminado
     *
     * @param boolean $terminado
     *
     * @return Jobs
     */
    public function setTerminado($terminado)
    {
        $this->terminado = $terminado;

        return $this;
    }

    /**
     * Get terminado
     *
     * @return boolean
     */
    public function getTerminado()
    {
        return $this->terminado;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function __toString(){
        return $this->getTitulo();
    }
}
