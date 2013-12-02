# PHP CSV Generator Class

## Example usage
    <?php

    	include 'csvgenerator.class.php';

    	$headings = array("Name", "Age", "Gender");
    	$data = array();
    	$data[] = array("John", "20", "Male");
    	$data[] = array("Jane", "19", "Female");

    	$csv = new CSVGenerator();
        $csv->setFilename('my_table.csv');
        $csv->startBuffer();

        // Add headings row
        $csv->addRow("Name", "Age", "Gender");

        // Add data rows
        foreach($data as $d) {
        	$csv->addRow($d);
        }

        $csv->closeBuffer();

    ?>