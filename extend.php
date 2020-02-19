class PDF_MC_Table extends FPDFS{    
    function CellMultiLine($width, $height, $text, $border, $newline, $align, $limit){
        // get parameter
        $words = explode(' ', $text);
        $kalimat = array();
        $cur_sentence = '';
        foreach($words as $key => $word){
            if(strlen($cur_sentence)+strlen($word)>$limit){
                $kalimat[] = $cur_sentence;
                $cur_sentence = '';
            }
            $cur_sentence .= $word.' ';
            if($key==count($words)-1){
                $kalimat[] = $cur_sentence;
                $cur_sentence = '';
            }
        }

        // draw border
        $cur_x = $this->GetX();
        $cur_y = $this->GetY();
        $total_height = $height * count($kalimat);
        $this->Cell($width, $total_height, '', $border, 1, 'C');

        // draw text
        foreach($kalimat as $key => $kal){
            $this->SetXY($cur_x, $cur_y+($key*$height));
            $this->Cell($width, $height, $kal, 0, 1, $align);
        }

        if(!$newline) $this->SetXY($cur_x+$width, $cur_y);

        return count($kalimat);
    }

    function CellTextTop($width, $height, $text, $border, $newline, $align, $multiple){
        $cur_x = $this->GetX();
        $cur_y = $this->GetY();
        $this->Cell($width, $height, $text, 0, 0, $align);
        $this->SetXY($cur_x, $cur_y);
        $this->Cell($width, $height*$multiple, '', $border, $newline, 'C');
    }
 }
