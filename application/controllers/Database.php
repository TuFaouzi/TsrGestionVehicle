<?php 
class Database extends CI_Controller{

    public function __construct(){ 
        parent::__construct(); 
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->database();
    } 

    function csv(){
        $tables = $this->db->list_tables();
        foreach ($tables as $table):
            $file = date("dMY")."-$table.csv";
            $query = $this->db->query("select * from $table"); 
            $delimiter = ",";
            $newline = "\r\n";
            $enclosure = '"';
            $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
            write_file("assets/data/csv/$file", $data);  
            // force_download($file, $data);
        endforeach;
    }

    function import($file = NULL){ 
        $csv_file = "assets/data/csv/$file"; // Name of your CSV file
        echo $table = explode('.',explode('-', $csv_file)[1])[0];
        if (($handle = fopen($csv_file, "r")) !== FALSE):
            while (($data = fgetcsv($handle, 1024, ",")) !== FALSE) {
                $csvData = array(
                    'account_id'       => $this->security->xss_clean($data[0]),
                    'sector_name'      => $this->security->xss_clean($data[1]),
                    'sector_type'      => $this->security->xss_clean($data[2]),
                    'status'           => $this->security->xss_clean($data[3]),
                    'date'             => $this->security->xss_clean($data[4]),
                ); 
                if($this->db->insert($table,$csvData)):
                    echo "row inserted\n";
                else:
                    echo die(mysql_error());
                endif;
            }
            fclose($handle);
            echo "CSV data successfully imported to table!!"; 
        endif;
    }

    function sql(){   
        $file = date("dMY").'-db.sql.gz';
        $backup = $this->dbutil->backup();   
        write_file("assets/data/sql/$file", $backup);  
        force_download($file, $backup); 
    }
}