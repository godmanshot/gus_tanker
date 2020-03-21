<?php

namespace App\Work;

use App\Work;

class DocxWorkWriter extends WorkWriter {

    public function write()
    {
        $balloon = $this->work->balloon();

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        header( "Content-Type: application/vnd.openxmlformats-officedocument.wordprocessing‌​ml.document" );
        header( 'Content-Disposition: attachment; filename='.time().'.docx' );

        \Debugbar::disable();

        $section = $phpWord->addSection();
        $section->addText($balloon);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        ob_start();

        $objWriter->save('php://output');

        $contents = ob_get_clean();
        
        return $contents;
    }
}