<?php

namespace classes;

class Item
{
    private $id;

    private $name;

    private $description;

    private $price;

    public static function convertItem(array $bdd_item)
    {
        $item = new Item();
        $item->setId($bdd_item["id"]);
        $item->setName($bdd_item["name"]);
        $item->setDescription($bdd_item["description"]);
        $item->setPrice($bdd_item["price"]);

        return $item;

    }

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription():string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice():float
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
}