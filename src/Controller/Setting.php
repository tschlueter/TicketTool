<?php
/**
 * Specifies all settings for the TicketTool.
 */
class Controller_Setting
{

    /** The version identifier. */
    const VERSION = '0.1a';

    /** The base URL of the JIRA service. */
    const JIRA_BASE_URL = 'https://bdc.bahag.com';

    /** The image size for the QR code to create. */
    const QR_IMAGE_SIZE = 6;

    /** The margin offset size for the QR code to create. */
    const QR_IMAGE_MARGIN = 0;

    /** The number of seconds per hour. */
    const SECONDS_PER_HOUR = 3600;

    /** The debug switch for enabling log output to the frontend. */
    const DEBUG_ENABLE_LOGS = true;
    /** The debug switch for testing the LaTeX implementation. */
    const DEBUG_TEST_LATEX = false;

    /** The page dimension for the output pdfs. A6 dimensions are 297.64 x 420.94 */
    const PDF_PAGE_DIMENSION = 'A6';
    /** The page orientation for the output pdfs. */
    const PDF_PAGE_ORIENTATION = 'P';
    /** The page measuring unit for all specified dimensions. */
    const PDF_PAGE_UNIT = 'pt';

}