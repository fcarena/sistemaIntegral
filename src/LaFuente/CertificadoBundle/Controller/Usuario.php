<?php
 
namespace LaFuente\CertificadoBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario extends BaseUser
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    protected $nombre;
    
    /**
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    protected $apellido;
    
    /**
     * @ORM\Column(name="dni", type="string", length=255, nullable=true)
     */
    protected $dni;
    
    /**
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    protected $telefono;
    
    /**
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    protected $direccion;
    
    /**
     * @ORM\Column(name="fechaNacimiento", type="datetime", nullable=true)
     */
    protected $fechaNacimiento;
    
    protected $roles = array();
    
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }
    
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getApellido() {
        return $this->apellido;
    }
    
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    
    public function getTelefono() {
        return $this->telefono;
    }
    
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    public function getDni() {
        return $this->dni;
    }
    
    public function setDni($dni) {
        $this->dni = $dni;
    }
    
    public function getDireccion() {
        return $this->direccion;
    }
    
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    
    public function __construct()
    {    
        parent::__construct();
        $this->fechaNacimiento = new \DateTime();
        $this->sistemas = new \Doctrine\Common\Collections\ArrayCollection();
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
    
    

    public function getUsername() {
        return $this->username;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getRoles() {
        return $this->roles;
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

    public function __toString(){
        return $this->getNombre(). ' ' .$this->getApellido();
    }
}
