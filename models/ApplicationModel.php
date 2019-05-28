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
        return $result;
    }

    private function numberOfOriginalStrophes($id)
    {
        $sQuery = 'SELECT COUNT(*) FROM strophes WHERE id_poem="' . $id . '"';
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll();
        return $result[0][0];
    }

    private function getIdBestTranslate($id)
    {
        $query = 'SELECT t1.id,t1.id_poem,u.FIRST_NAME,u.LAST_NAME,p.TITLE,p.LANGUAGE,a.name FROM translations t1 join users u ON u.ID=t1.ID_USER join poems p ON p.ID=t1.ID_POEM JOIN AUTHORS a ON a.id=p.id_author where rating=( SELECT MAX(rating) FROM translations WHERE id_poem=' . $id . ')';
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
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<rss version=\"2.0\">\n";
        $poeme = $this->loadAllPoems();
        $vector = [];
        // luam numarul de strofe originale pentru fiecare traducere
        for ($i = 1; $i <= $this->numberOfPoems(); $i++) {
            $vector[$i] = $this->numberOfOriginalStrophes($poeme[$i - 1][0]);
        }

        for ($i = 1; $i <= $this->numberOfPoems(); $i++) {
            $traduceri[$i] = $this->getIdBestTranslate($poeme[$i - 1][0]);
        }
        for ($i = 1; $i <= $this->numberOfPoems(); $i++) {
            $info[$i] = $this->getNoTranslated(intval($traduceri[$i]));
        }
        for ($i = 1; $i <= count($info); $i++) {
            if ($info[$i] == $vector[$i]) {

                $xml .= "<poem>\n\t";
                $xml .= "<traducator>\n";
                $xml .= "\t\t".$traduceri[$i]['FIRST_NAME'] . " ".$traduceri[$i]['LAST_NAME']  ;
                $xml .= "\n\t</traducator>\n";
                $xml .= "\t<numepoem>\n";
                $xml .= "\t\t".$traduceri[$i]['TITLE'];
                $xml .= "\n\t</numepoem>\n";
                $xml .= "\t<limba>\n";
                $xml .= "\t\t".$traduceri[$i]['LANGUAGE'] ;
                $xml .= "\n\t</limba>\n";
                $xml .= "\t<autor>\n";
                $xml .= "\t\t".$traduceri[$i]['name'];
                $xml .= "\n\t</autor>\n";
                $xml .= "</poem>\n";
            }
        }


        $xml .= "</rss>\n\r";
        $xmlobj = new SimpleXMLElement($xml);
        $xmlobj->asXML("storage/test.rss");
    }

}