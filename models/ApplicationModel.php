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

    private function getIdBestTranslate($id)
    {
        $query = 'SELECT t1.id,t1.id_poem,u.FIRST_NAME,u.LAST_NAME FROM translations t1 join users u ON u.ID=t1.ID_USER where rating=( SELECT MAX(rating) FROM translations WHERE id_poem=' . $id . ')';
        $OUTPUT = $this->db->prepare($query);
        $OUTPUT->execute();
        $result = $OUTPUT->fetch();
        return $result;
    }

    private function getNoTranslated($id)
    {
        $query = 'SELECT COUNT(nth) FROM translation_strophes WHERE id_translation=' . $id;
        $OUTPUT = $this->db->prepare($query);
        $OUTPUT->execute();
        $result = $OUTPUT->fetch();
        return $result[0][0];
    }

    public function generateRSS()
    {
        $xml = "<libraray>\n\t\t";
        $poeme = $this->loadAllPoems();
        $vector = [];
        // luam numarul de strofe originale pentru fiecare traducere
        for ($i = 1; $i <= $this->numberOfPoems(); $i++) {
            $vector[$i] = $this->numberOfOriginalStrophes($poeme[$i - 1][0]);
        }

        var_dump($poeme);
        var_dump($vector);
        for ($i = 1; $i <= $this->numberOfPoems(); $i++) {
            $traduceri[$i] = $this->getIdBestTranslate($poeme[$i - 1][0]);
        }
        var_dump($traduceri);
        for ($i = 1; $i <= $this->numberOfPoems(); $i++) {
            $info[$i] = $this->getNoTranslated(intval($traduceri[$i]));
        }
        for ($i = 1; $i <= count($info); $i++) {
            if ($info[$i] == $vector[$i]) {

                $xml .= "<mail_address>\n\t\t";
                $xml .= $traduceri[$i]['FIRST_NAME'];
                $xml .= "<email> sss </email>\n\t\t";
                $xml .= "<verify_code> ssss </verify_code>\n\t\t";
                $xml .= "<status>asda</status>\n\t\t";
                $xml .= "<status1>dadada</status1>\n\t\t";
                $xml .= "</mail_address>\n";
            }
        }


        $xml .= "</libraray>\n\r";
        $xmlobj = new SimpleXMLElement($xml);
        $xmlobj->asXML("storage/test.rss");
    }

}