<?php
 
namespace Techsevin\CustomApi\Api;
 
interface CustomerFeedbackLinkManagementInterface
{
    /**
     * GET for Post api
     * @param int $feedbackId
     * @return mixed
     */
    public function getAssignedFeedback($feedbackId = null);
}