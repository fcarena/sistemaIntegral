<?php

namespace LaFuente\PrestamoBundle\Entity;

use LaFuente\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Prestamo
 *
 * @ORM\Table(name="prestamos")
 * @ORM\Entity(repositoryClass="LaFuente\PrestamoBundle\Entity\PrestamoRepository")
 */
class Prestamo
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recibido_el", type="datetime", nullable=true)
     */
    private $fechaRecibido;

    /**
     * @ORM\ManyToOne(targetEntity="LaFuente\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="prestador_id", referencedColumnName="id")
     **/
    protected $prestador;

    /**
     * @ORM\ManyToOne(targetEntity="LaFuente\UserBundle\Entity\User", inversedBy="prestamos")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     **/
    protected $usuario;

    /**
     * @ORM\OneToMany(targetEntity="PrestamoProducto", mappedBy="prestamo")
     **/
    protected $products;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=63)
     */
    private $estado;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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


    public function __toString()
    {
        return (String) $this->getId();
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Prestamo
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }


    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get fechaRecibido
     *
     * @return \DateTime
     */
    public function getFechaRecibido()
    {
        return $this->fechaRecibido;
    }

    /**
     * Set fechaRecibido
     *
     * @param \DateTime $fechaRecibido
     * @return Prestamo
     */
    public function setFechaRecibido($fechaRecibido)
    {
        $this->fechaRecibido = $fechaRecibido;

        return $this;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Prestamo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Prestamo
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

    /**
     * Set prestador
     *
     * @param \LaFuente\UserBundle\Entity\User $prestador
     * @return Prestamo
     */
    public function setPrestador(\LaFuente\UserBundle\Entity\User $prestador = null)
    {
        $this->prestador = $prestador;

        return $this;
    }

    /**
     * Get prestador
     *
     * @return \LaFuente\UserBundle\Entity\User
     */
    public function getPrestador()
    {
        return $this->prestador;
    }

    /**
     * Set usuario
     *
     * @param \LaFuente\UserBundle\Entity\User $usuario
     * @return Prestamo
     */
    public function setUsuario(\LaFuente\UserBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \LaFuente\UserBundle\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add products
     *
     * @param \LaFuente\PrestamoBundle\Entity\PrestamoProducto $products
     * @return Prestamo
     */
    public function addProduct(\LaFuente\PrestamoBundle\Entity\PrestamoProducto $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \LaFuente\PrestamoBundle\Entity\PrestamoProducto $products
     */
    public function removeProduct(\LaFuente\PrestamoBundle\Entity\PrestamoProducto $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
