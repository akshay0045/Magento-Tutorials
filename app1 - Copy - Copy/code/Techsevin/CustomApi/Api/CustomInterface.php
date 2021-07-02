<?php
 
namespace Techsevin\CustomApi\Api;
 
interface CustomInterface
{
    /**
     * GET for Post api
     * @param string $customer_name     (customer name)
     * @param string $customer_email
     * @param string $customer_phone
     * @param string $customer_subject
     * @param string $customer_message
     * @param string $rating
     * @param string $image
     * @return string
     */
 
    public function getPost($customer_name, $customer_email, $customer_phone, $customer_subject, $customer_message, $rating, $image);
}