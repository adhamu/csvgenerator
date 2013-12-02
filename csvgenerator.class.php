<?php

/**
 * (Very) basic CSV export class
 * @author Amit Dhamu
 * @since November 2013
 */

class CSVGenerator
{

    private $filename;
    private $handle;
    private $mode;
    private $delimiter;
    private $enclosure;
    private $isAttachment;

    /**
     * Constructor sets default values for $mode, $delimiter, $enclosure, $isAttachment to most commonly used
     */
    public function __construct()
    {
        $this->mode = 'w';
        $this->delimiter = ',';
        $this->enclosure = '"';
        $this->isAttachment = true;
    }

    /**
     * Sets the filename of the downloaded CSV
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Sets the stream access mode for the buffer
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Sets the field delimiter for the fputcsv function
     * @param string $delimiter
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * Sets the field enclosure
     * @param string $enclosure
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
    }

    /**
     * Sets the isAttachment parameter to true or false
     * @param boolean $boolean
     */
    public function setIsAttachment($boolean)
    {
        $this->isAttachment = $boolean;
    }

    /**
     * Starts the output buffer stream for the csv
     */
    public function startBuffer()
    {
        $this->isAttachment ? $this->fileHeaders() : null;
        $this->handle = fopen('php://output', $this->mode);
    }

    /**
     * The file headers required to download the csv file
     */
    private function fileHeaders()
    {
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename='.$this->filename);
        header('Expires: 0');
        header('Pragma: public');
    }

    /**
     * Adds a csv row into the output buffer stream
     * @param array $row
     */
    public function addRow($row)
    {
        fputcsv($this->handle, $row, $this->delimiter, $this->enclosure);
    }

    /**
     * Closes the output buffer and downloads/displays the file
     * exit() is required so it doesn't add anything after this function to the csv file
     */
    public function closeBuffer()
    {
        fclose($this->handle);
        exit;
    }
}
