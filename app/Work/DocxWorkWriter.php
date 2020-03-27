<?php

namespace App\Work;

use App\Work;

class DocxWorkWriter extends WorkWriter {

    // public function write($path)
    // {
    //     $balloon = json_encode($this->work->balloons());

    //     $phpWord = new \PhpOffice\PhpWord\PhpWord();

    //     $section = $phpWord->addSection();
    //     $section->addText($balloon);

    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

    //     $objWriter->save($path.'/'.time().'.docx');

    //     return $path.'/'.time().'.docx';
    // }

    public function write($path, $template = null)
    {
        $station = station();
        $id_of_company = $station->id_of_company;
        $station_boss = $station->boss_otk;
        $station_full_name = $station->full_name;
        $сertificate_install = $station->сertificate_install;

        $work_id = $this->work->id;
        $client_info = $this->work->client->info;
        $client_address = $this->work->client->address;
        $car_info = $this->work->auto_name();
        $car_year = $this->work->car_year();
        $car_body_number = $this->work->car_body_number();
        $car_gov_number = $this->work->gov_number();
        $vin = $this->work->vin();
        $auto_length = $this->work->auto_length();
        $gbo_type = $this->work->gbo_type();
        $ballon_manufacturer = $this->work->ballon_manufacturer();
        $manufacturer_country = $this->work->manufacturer_country();
        
        
        $type_work_engine = $this->work->car->type_work_engine;
        $equipment = $this->work->car->equipment;
        $state = $this->work->car->state;

        $balloons = collect($this->work->balloonsWithoutManufacturerAndType())->implode('name', '; ');
        $company_name = $this->work->company_name();

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template);

        $templateProcessor->setValue('work_id', $work_id);
        
        $templateProcessor->setValue('companyName', $company_name);
        $templateProcessor->setValue('id_of_company', $id_of_company);
        $templateProcessor->setValue('station_boss', $station_boss);
        $templateProcessor->setValue('station_full_name', $station_full_name);
        $templateProcessor->setValue('сertificate_install', $сertificate_install);
        $templateProcessor->setValue('year', date('Y'));
        $templateProcessor->setValue('client_info', $client_info);
        $templateProcessor->setValue('client_address', $client_address);
        $templateProcessor->setValue('car_info', $car_info);
        $templateProcessor->setValue('car_year', $car_year);
        $templateProcessor->setValue('car_body_number', $car_body_number);
        $templateProcessor->setValue('car_gov_number', $car_gov_number);
        $templateProcessor->setValue('vin', $vin);
        $templateProcessor->setValue('auto_length', $auto_length);
        $templateProcessor->setValue('type_work_engine', $type_work_engine);
        $templateProcessor->setValue('equipment', $equipment);
        $templateProcessor->setValue('state', $state);
        $templateProcessor->setValue('gbo_type', $gbo_type);
        $templateProcessor->setValue('manufacturer_country', $manufacturer_country);
        $templateProcessor->setValue('ballon_manufacturer', $ballon_manufacturer);
        $templateProcessor->setValue('balloons', $balloons);
        
        $templateProcessor->saveAs($path.'/'.time().'.docx');

        return $path.'/'.time().'.docx';
    }
}