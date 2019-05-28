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

    private function numarStrofeTraduse($id)
    {
        $query = 'SELECT COUNT(nth) FROM translation_strophes WHERE id_translation=' . intval($id);
        $OUTPUT = $this->db->prepare($query);
        $OUTPUT->execute();
        $result = $OUTPUT->fetch();
        return $result[0][0];
    }

    public function loadBodyRss($translation_id)
    {
        $SQL = 'SELECT NTH, TEXT FROM translation_strophes
                WHERE ID_TRANSLATION = ' . $translation_id . '
                ORDER BY NTH ASC';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($statement->rowCount() < 1) {
            return;
        }
        return $result;
    }

    private function idTraducereMaxPerLimba()
    {
       // $sQuery = 'SELECT *  from translations GROUP BY LANGUAGE HAVING (rating,LANGUAGE) in (SELECT MAX(rating) , language FROM translations GROUP BY language) ; ';
        $sQuery = 'SELECT *  from translations ';
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll();
        return $result;
    }

    private function getInfoAboutPoem($id, $idu)
    {
        $sql = "SELECT * FROM poems p JOIN authors a ON p.ID_AUTHOR=a.ID JOIN users u ON u.ID=$idu WHERE p.ID=$id";
        $out = $this->db->prepare($sql);
        $out->execute();
        $res = $out->fetch();
        return $res;
    }

    public function loadTranslationBody($translation_id)
    {
        $SQL = 'SELECT TEXT FROM translation_strophes
                WHERE ID_TRANSLATION = ' . $translation_id . '
                ORDER BY NTH ASC';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($statement->rowCount() < 1) {
            return;
        }

        return $result;
    }

    public function generateRSS()
    {
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
                <rss version=\"2.0\">\n";
        $idTraduceriRatingMax = $this->idTraducereMaxPerLimba();
        for ($i = 0; $i < count($idTraduceriRatingMax); $i++) {
            if ($this->numberOfOriginalStrophes($idTraduceriRatingMax[$i][1]) == $this->numarStrofeTraduse($idTraduceriRatingMax[$i][0])) {
                $informatiePoezie = $this->getInfoAboutPoem($idTraduceriRatingMax[$i][1], $idTraduceriRatingMax[$i][2]);
                $translatedPoem = $this->loadTranslationBody($idTraduceriRatingMax[$i][0]);
                $new_body = '';
                foreach ($translatedPoem as $poem_strophe)
                    $new_body = $new_body . "\n\t" . $poem_strophe['TEXT'];
                $xml .= "<poem>\n\t";
                $xml .= "<traducator>\n";
                $xml .= "\t\t" . $informatiePoezie['FIRST_NAME'] . " " . $informatiePoezie['LAST_NAME'];
                $xml .= "\n\t</traducator>\n";
                $xml .= "\t<numepoem>\n";
                $xml .= "\t\t" . $informatiePoezie['TITLE'];
                $xml .= "\n\t</numepoem>\n";
                $xml .= "\t<limba>\n";
                $xml .= "\t\t" . $idTraduceriRatingMax[$i][4];
                $xml .= "\n\t</limba>\n";
                $xml .= "\t<autor>\n";
                $xml .= "\t\t" . $informatiePoezie['NAME'];
                $xml .= "\n\t</autor>\n";
                $xml .= "\t<text>\n";
                $xml .= "\t\t" . $new_body;
                $xml .= "\n\t</text>\n";
                $xml .= "</poem>\n";
            }
        }
        $xml .= "</rss>\n\r";
        $xmlobj = new SimpleXMLElement($xml);
        $xmlobj->asXML("storage/test.rss");


    }

}