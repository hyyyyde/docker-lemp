<?php

namespace tests\Model;

use Model\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function setUp()
    {
        $product = new Product();
        $product->create();
        $product->truncate();
        $product->insert("docker product name");
    }

    public function tearDown()
    {
        $product = new Product();
        $product->truncate();
    }

    public function testGetAll()
    {
        $product = new Product();
        $products = $product->getAll();
        foreach ($products as $row) {
            $this->assertRegExp("/docker product name/", $row["name"]);
        }
    }
}
