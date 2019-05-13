<?php

require_once('libraries/Model.php');

class ApplicationModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function numberOfPoems()
    {
        $sQuery = "SELECT COUNT(*) FROM poems";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll();
        return $result[0][0];
    }

    public function loadAllPoems()
    {
        $sQuery = "SELECT id FROM poems";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll();
       // var_dump($result);
        return $result;
    }
    private function numberOfOriginalStrophes($id){
        $sQuery='SELECT COUNT(*) FROM strophes WHERE id_poem="'.$id.'"';
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll();
        return $result[0][0];
    }

    public function generateRSS()
    {
        $poeme = $this->loadAllPoems();
        for ($i = 0; $i <$this->numberOfPoems(); $i++) {
            $vector[$i]=$this->numberOfOriginalStrophes($i);
        }

        $xml = "<libraray>\n\t\t";
        $xml .= "<mail_address>\n\t\t";
        $xml .= "<id> sss </id>\n\t\t";
        $xml .= "<email> sss </email>\n\t\t";
        $xml .= "<verify_code> ssss </verify_code>\n\t\t";
        $xml .= "<status>asda</status>\n\t\t";
        $xml .= "<status1>dadada</status1>\n\t\t";
        $xml .= "</mail_address>\n\t";

        $xml .= "</libraray>\n\r";
        $xmlobj = new SimpleXMLElement($xml);
        $xmlobj->asXML("storage/test.rss");
    }

}