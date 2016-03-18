<?php

namespace LaFuente\PrestamoBundle\Entity;

use LaFuente\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * PrestamoProducto
 *
 * @ORM\Table(name="prestamos_productos")
 * @ORM\Entity(repositoryClass="LaFuente\PrestamoBundle\Entity\PrestamoProductoRepository")
 */
class PrestamoProducto
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
     * @ORM\ManyToOne(targetEntity="Prestamo", inversedBy="products")
     * @ORM\JoinColumn(name="prestamo_id", referencedColumnName="id")
     **/
    protected $prestamo;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="prestamos")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     **/
    protected $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="devuelto_at", type="datetime", nullable=true)
     */
    private $devueltoAt;

    /**
     * @ORM\ManyToOne(targetEntity="LaFuente\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="$recibido_by", referencedColumnName="id", nullable=true)
     **/
    protected $recibidoBy;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

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
     * Set devueltoAt
     *
     * @param \DateTime $devueltoAt
     * @return PrestamoProducto
     */
    public function setDevueltoAt($devueltoAt)
    {
        $this->devueltoAt = $devueltoAt;

        return $this;
    }

    /**
     * Get devueltoAt
     *
     * @return \DateTime
     */
    public function getDevueltoAt()
    {
        return $this->devueltoAt;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return PrestamoProducto
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
     * Set prestamo
     *
     * @param \LaFuente\PrestamoBundle\Entity\Prestamo $prestamo
     * @return PrestamoProducto
     */
    public function setPrestamo(\LaFuente\PrestamoBundle\Entity\Prestamo $prestamo = null)
    {
        $this->prestamo = $prestamo;

        return $this;
    }

    /**
     * Get prestamo
     *
     * @return \LaFuente\PrestamoBundle\Entity\Prestamo
     */
    public function getPrestamo()
    {
        return $this->prestamo;
    }

    /**
     * Set product
     *
     * @param \LaFuente\PrestamoBundle\Entity\Product $product
     * @return PrestamoProducto
     */
    public function setProduct(\LaFuente\PrestamoBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \LaFuente\PrestamoBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set recibidoBy
     *
     * @param \LaFuente\UserBundle\Entity\User $recibidoBy
     * @return PrestamoProducto
     */
    public function setRecibidoBy(\LaFuente\UserBundle\Entity\User $recibidoBy = null)
    {
        $this->recibidoBy = $recibidoBy;

        return $this;
    }

    /**
     * Get recibidoBy
     *
     * @return \LaFuente\UserBundle\Entity\User
     */
    public function getRecibidoBy()
    {
        return $this->recibidoBy;
    }
}
