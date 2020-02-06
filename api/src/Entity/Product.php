<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *      subresourceOperations={
 *          "api_stores_products_get_subresource"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"stores_products:read"}}
 *          }
 *      },
*       collectionOperations={
 *          "post"={"security"="user.hasRole('STORE_MANAGER')"},
 *          "get"={
 *              "security"="user.hasRole('ADMIN')",
 *              "normalization_context"={"groups"={"products:read"}}
 *          }
 *      },
 *      itemOperations={
 *          "put"={"security"="user.hasRole('SELLER')"},
 *          "get",
 *          "delete"={"security"="user.hasRole('STORE_MANAGER')"}
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"stores_products:read", "products:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stores_products:read", "products:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"stores_products:read", "products:read"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Store", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"products:read"})
     */
    private $store;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): self
    {
        $this->store = $store;

        return $this;
    }
}
