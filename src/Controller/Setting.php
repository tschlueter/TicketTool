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

    /** The output path for all pdf files. */
    const PATH_OUT_PDF = 'out/pdf/';
    /** The output path for all temporary files. */
    const PATH_OUT_TMP = 'out/tmp/';

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

    const PDF_FONT_FACE = 'Arial';
    /** Font size for 'ticket details' */
    const PDF_FONT_SIZE_DETAILS = 12.5;
    /** Font size for 'ticket id' */
    const PDF_FONT_SIZE_ID = 27.5;
    /** Font size for 'ticket title' */
    const PDF_FONT_SIZE_TITLE = 22.5;

    /** Offset x for all texts. */
    const PDF_TEXT_BORDER_X = 10.0;
    /** Offset y for all texts. */
    const PDF_TEXT_BORDER_Y = 10.0;

    /** Offset x for the rect. */
    const PDF_RECT_BORDER_X = 0.0;
    /** Offset y for the rect. */
    const PDF_RECT_BORDER_Y = 0.0;

    /** Y offset of the ticket id. */
    const PDF_OFFSET_TICKET_ID_Y = 15.0;
    /** Offset y for the ticket title. */
    const PDF_OFFSET_TICKET_TITLE_Y = 30.0;
    /** Y offset for the qr code image. */
    const PDF_OFFSET_IMAGE_Y = 20.0;

    /** Height of the ticket title block element. */
    const PDF_TICKET_TITLE_BLOCK_HEIGHT = 30.0;

}