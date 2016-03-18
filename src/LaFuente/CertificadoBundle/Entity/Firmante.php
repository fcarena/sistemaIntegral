<?php

namespace LaFuente\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Firmante
 *
 * @ORM\Table(name="Firmante")
 * @ORM\Entity
 */
class Firmante
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
     * @ORM\Column(name="tipoRolFirmante", type="string", length=255, nullable=false)
     */
    private $tipoRolFirmante;


     /**
     * @ORM\ManyToMany(targetEntity="Jobs", mappedBy="firmantes")
     */
     protected $jobs;

    /**
     * @var string
     *
     * @ORM\Column(name="firma", type="blob", nullable=true)
     * @Assert\File(maxSize="5M", mimeTypes={"image/gif", "image/jpeg", "image/png", "image/jpg"})
     */
    protected $firma;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_mime", type="string", length=64, nullable=true)
     */
    protected $firmaType;

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
     * @return Firmante
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
     * @return Firmante
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
     * Set tipoRolFirmante
     *
     * @param string $tipoRolFirmante
     *
     * @return Firmante
     */
    public function setTipoRolFirmante($tipoRolFirmante)
    {
        $this->tipoRolFirmante = $tipoRolFirmante;

        return $this;
    }

    /**
     * Get tipoRolFirmante
     *
     * @return string
     */
    public function getTipoRolFirmante()
    {
        return $this->tipoRolFirmante;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add job
     *
     * @param \LaFuente\CertificadoBundle\Entity\Jobs $job
     *
     * @return Firmante
     */
    public function addJob(\LaFuente\CertificadoBundle\Entity\Jobs $job)
    {
        $this->jobs[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \LaFuente\CertificadoBundle\Entity\Jobs $job
     */
    public function removeJob(\LaFuente\CertificadoBundle\Entity\Jobs $job)
    {
        $this->jobs->removeElement($job);
    }

    public function removeAllJobs(){
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    public function setFirmaBlob(File $file)
    {
        if (!$file){
            $this->setFirma(null);
            $this->setFirmaType(null);
            return $this;
        }

        if(!$file->isValid()){
            throw new FileException("Invalid File");
        }

        $imageFile    = fopen($file->getRealPath(), 'r');
        $imageContent = fread($imageFile, $file->getClientSize());
        fclose($imageFile);
        $this->setFirma($imageContent);
        $this->setFirmaType($file->getMimeType());
        return $this;
    }

    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Set firma
     *
     * @param string $firma
     *
     * @return Firmante
     */
    public function setFirma($firma=null)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return string
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set firmaType
     *
     * @param string $firmaType
     *
     * @return Firmante
     */
    public function setFirmaType($firmaType=null)
    {
        $this->firmaType = $firmaType;

        return $this;
    }

    /**
     * Get firmaType
     *
     * @return string
     */
    public function getFirmaType()
    {
        return $this->firmaType;
    }
}
