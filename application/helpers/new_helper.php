<?php 
function yourHelperFunction(){
        $ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from logo order by logo_id desc limit 1"; 
        $query = $ci->db->query($sql);
        return   $row = $query->result();
}

function cssFunction(){
        $ci=& get_instance();
        $ci->load->database(); 

        $sql = "SELECT * from web_setting where id='1'"; 
        $query = $ci->db->query($sql);
        return   $row = $query->result();
}

function faviconFunction(){
        $ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from logo order by logo_id desc limit 1";
        $query = $ci->db->query($sql);
        return   $row = $query->result();
}

?>