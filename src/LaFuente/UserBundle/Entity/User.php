<?php

namespace LaFuente\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use LaFuente\PrestamoBundle\Entity\Prestamo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="LaFuente\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    protected $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigoPostal", type="string", length=255, nullable=true)
     */
    protected $codigoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=255, nullable=true)
     */
    protected $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=255, nullable=true)
     */
    protected $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="casaNro", type="string", length=255, nullable=true)
     */
    protected $casaNro;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    protected $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=255, unique=true, nullable=true)
     */
    protected $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=255, nullable=true)
     */
    protected $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=255, nullable=true)
     */
    protected $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_mime", type="string", length=64, nullable=true)
     */
    protected $imageType;

    /**
     * @ORM\OneToMany(targetEntity="LaFuente\PrestamoBundle\Entity\Prestamo", mappedBy="usuario")
     **/
    protected $prestamos;

    protected $roles = array();


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->prestamos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setImageBlob(File $file)
    {
        if (!$file){
            $this->setImage(null);
            $this->setImageType(null);
            return $this;
        }

        if(!$file->isValid()){
            throw new FileException("Invalid File");
        }

        $imageFile    = fopen($file->getRealPath(), 'r');
        $imageContent = fread($imageFile, $file->getClientSize());
        fclose($imageFile);
        $this->setImage($imageContent);
        $this->setImageType($file->getMimeType());
        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return User
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
     * Set apellido
     *
     * @param string $apellido
     * @return User
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return User
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
     * Set sexo
     *
     * @param string $sexo
     * @return User
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return User
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return base64_encode(stream_get_contents($this->image));
    }

    /**
     * Set imageType
     *
     * @param string $imageType
     * @return User
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;

        return $this;
    }

    /**
     * Get imageType
     *
     * @return string
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * Add prestamos
     *
     * @param \LaFuente\PrestamoBundle\Entity\Prestamo $prestamos
     * @return User
     */
    public function addPrestamo(\LaFuente\PrestamoBundle\Entity\Prestamo $prestamos)
    {
        $this->prestamos[] = $prestamos;

        return $this;
    }

    /**
     * Remove prestamos
     *
     * @param \LaFuente\PrestamoBundle\Entity\Prestamo $prestamos
     */
    public function removePrestamo(\LaFuente\PrestamoBundle\Entity\Prestamo $prestamos)
    {
        $this->prestamos->removeElement($prestamos);
    }

    /**
     * Get prestamos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrestamos()
    {
        return $this->prestamos;
    }

    /**
     * Set codigoPostal
     *
     * @param string $codigoPostal
     *
     * @return User
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return User
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set calle
     *
     * @param string $calle
     *
     * @return User
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set casaNro
     *
     * @param string $casaNro
     *
     * @return User
     */
    public function setCasaNro($casaNro)
    {
        $this->casaNro = $casaNro;

        return $this;
    }

    /**
     * Get casaNro
     *
     * @return string
     */
    public function getCasaNro()
    {
        return $this->casaNro;
    }

        /**
     * Agrega un rol al usuario.
     * @throws Exception
     * @param Rol $rol
     */
    public function addRole( $rol )
    {
      array_push($this->roles, $rol);
    }
}
