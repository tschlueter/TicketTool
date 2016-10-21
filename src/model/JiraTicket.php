<?php
/**
 * Represents the primal information of one JIRA ticket.
 */
class JiraTicket
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
     * Creates a new JIRA ticket model.
     *
     * @param string $id
     * @param string $title
     */
    public function __construct($id, $title)
    {
        $this->_id    = $id;
        $this->_title = $title;
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

}