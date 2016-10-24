<?php
/**
 * Represents the primal information of one JIRA ticket.
 */
class Model_JiraTicket
{

    /**
     * @var string
     */
    private $_id;

    /**
     * @var string
     */
    private $_title;

    /**
     * @var string
     */
    private $_type;

    /**
     * @var string
     */
    private $_estimation;

    /**
     * Creates a new JIRA ticket model.
     *
     * @param string $id
     * @param string $title
     * @param string $type
     * @param string $estimation
     */
    public function __construct($id, $title, $type, $estimation)
    {
        $this->_id         = $id;
        $this->_title      = $title;
        $this->_type       = $type;
        $this->_estimation = $estimation;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return string
     */
    public function getEstimation()
    {
        return $this->_estimation;
    }

}