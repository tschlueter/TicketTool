<?php
/**
 * Specifies all settings for the TicketTool.
 */
class Controller_Setting
{

    /**
     * The version identifier.
     */
    const VERSION = '0.1a';

    /**
     * The base URL of the JIRA service.
     */
    const JIRA_BASE_URL = 'https://bdc.bahag.com';

    /**
     * The image size for the QR code to create.
     */
    const QR_IMAGE_SIZE = 6;

    /**
     * The margin offset size for the QR code to create.
     */
    const QR_IMAGE_MARGIN = 0;

    /**
     * The debug switch for testing the LaTeX implementation.
     */
    const DEBUG_TEST_LATEX = false;

    /**
     * The debug switch for enabling log output to the frontend.
     */
    const DEBUG_ENABLE_LOGS = true;

}