<?php
/**
 * Specifies all settings for the TicketTool.
 */
class Controller_Setting
{

    /** The application title. */
    const TITLE = 'BAHAG TicketTool';
    /** The version identifier. */
    const VERSION = '2.0.0 2016-11-18 19:09:24';

    /** The image size for the QR code to create. */
    const QR_IMAGE_SIZE = 6.5;
    /** The margin offset size for the QR code to create. */
    const QR_IMAGE_MARGIN = 0;
    /** The position y of the QR code */
    const QR_IMAGE_POSITION_Y = 8;

    /** The number of seconds per hour. */
    const SECONDS_PER_HOUR = 3600;

    /** The maximum number of characters in the ticket title. */
    const MAX_TITLE_LENGTH = 55;

    /** The resource path for text files. */
    const PATH_RES_TXT = 'res/txt';
    /** The input path for importing the settings. */
    const PATH_IN_SETTINGS = 'in/settings.json';
    /** The input path for importing the XML file. */
    const PATH_IN_XML = 'in/SearchRequest.xml';
    /** The output path for all pdf files. */
    const PATH_OUT_PDF = 'out/pdf/';
    /** The output path for temporary created images. */
    const PATH_OUT_TMP_IMAGE = 'out/tmp/image/';
    /** The output path for temporary created latex documents. */
    const PATH_OUT_TMP_LATEX = 'out/tmp/latex/';

    /** The page dimension for the output pdfs. A6 dimensions are 297.64 x 420.94 */
    const PDF_PAGE_DIMENSION = 'A6';
    /** The page orientation for the output pdfs. */
    const PDF_PAGE_ORIENTATION = 'P';
    /** The page measuring unit for all specified dimensions. */
    const PDF_PAGE_UNIT = 'pt';

    /** Whether to draw a border around each page or not. */
    const PDF_DRAW_BORDER = false;

    /** The font to use for all texts in the pdf. */
    const PDF_FONT_FACE = 'Arial';
    /** Font style for 'ticket details' */
    const PDF_FONT_DETAILS_STYLE = 'B';
    /** Font size for 'ticket details' */
    const PDF_FONT_DETAILS_SIZE = 18.5;
    /** Font size for 'ticket id' */
    const PDF_FONT_SIZE_ID = 27.5;
    /** Font size for 'ticket title' */
    const PDF_FONT_SIZE_TITLE = 30.0;

    /** Offset x for all texts. */
    const PDF_TEXT_BORDER_X = 5.0;
    /** Offset y for all texts. */
    const PDF_TEXT_BORDER_Y = 5.0;

    /** Offset x for the rect. */
    const PDF_RECT_BORDER_X = 0.0;
    /** Offset y for the rect. */
    const PDF_RECT_BORDER_Y = 0.0;

    /** Y offset of the ticket id. */
    const PDF_OFFSET_TICKET_ID_Y = 25.0;
    /** Offset y for the ticket title. */
    const PDF_OFFSET_TICKET_TITLE_Y = 0.0;

    /** Height of the ticket title block element. */
    const PDF_TICKET_TITLE_BLOCK_HEIGHT = 40.0;

    /** The debug switch for enabling log output to the frontend. */
    public static $DEBUG_ENABLE_LOGS = true;
    /** The debug switch for testing the LaTeX implementation. */
    const DEBUG_TEST_LATEX = false;
    /** The debug switch for supersizing all dynamic strings that are printed into the pdf. */
    const DEBUG_SUPERSIZE_TITLE = false;

    /** The action ID for showing the upload and input form. */
    const ACTION_ID_SHOW_UPLOAD_FORM = 0;
    /** The action ID for creating the PDF from the specified ticket IDs. */
    const ACTION_ID_CREATE_PDF_FROM_TICKET_IDS = 1;
    /** The action ID for creating the PDF from an XML file. */
    const ACTION_ID_CREATE_PDF_FROM_XML = 2;

}