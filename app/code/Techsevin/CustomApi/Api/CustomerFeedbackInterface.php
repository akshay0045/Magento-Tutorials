<?php
 
namespace Techsevin\CustomApi\Api;
 
interface CustomerFeedbackInterface
{
    /**
     * GET for Post api
     * @param array $data
     * @return mixed
     */
    public function getFeedback();
}