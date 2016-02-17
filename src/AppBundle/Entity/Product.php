<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Создание сущностей и репозиториев (этапы):
 * создание сущности (следовать подсказкам в консоли):
 * - php app/console doctrine:generate:entity
 *
 * создание геттеров и сеттеров в сущности
 * (должно выполняться каждый раз после изменения свойств класса сущности):
 * для всего бандла:
 * - php app/console doctrine:generate:entities AppBundle
 * для конкретной сущности:
 * - php app/console doctrine:generate:entities AppBundle/Entity/Product
 *
 * обновление данных в БД (так):
 * - php app/console doctrine:schema:update --force
 *
 * или использовать миграции (когда изучу)
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 *
 * индикатор встроенного триггера, см. setCreatedAtValue()
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @ORM\Column(type="string", length=100)
    */
    protected $name;

    /**
    * @ORM\Column(type="decimal", scale=2)
    */
    protected $price;

    /**
    * @ORM\Column(type="text")
    */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Метод выполняется в виде триггера
     * при сохранении нового продукта в БД - индикатор PrePersist
     *
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        echo "
            <script>
                var today = new Date();
                alert(today);
            </script>
        ";
    }
}
