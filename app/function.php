<?php 

function getProductImagePath(int $productId): string
{
    return './images/products/product' . $productId . '.jpg';
}