<?php

namespace Database\Seeders;

use App\Models\TypeDocumentIdentification;
use Illuminate\Database\Seeder;

class TypeDocumentIdentificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type_document_identifications = [
            'Cédula de ciudadanía',
            'Tarjeta de extranjería',
            'Cédula de extranjería',
            'NIT',
            'Pasaporte',
            'Documento de identificación extranjero',
            'NIT de otro país',
        ];

        foreach ($type_document_identifications as $type_document_identification) {
            TypeDocumentIdentification::create(['name' => $type_document_identification]);
        }
    }
}
