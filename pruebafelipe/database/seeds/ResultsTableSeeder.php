<?php

use Illuminate\Database\Seeder;

class ResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('results')->insert([
         ['description' => 'Otro'],
         ['description' => 'Consultas médicas'],
         ['description' => 'Jornadas de vacunación'],
         ['description' => 'Huertos familiares'],
         ['description' => 'Jornadas de limpieza'],
         ['description' => 'Políticas municipales'],
         ['description' => 'Diseño de planos'],
         ['description' => 'Talleres de capacitación'],
         ['description' => 'Manuales'],
         ['description' => 'Planes'],
         ['description' => 'Guías metodológicas'],
         ['description' => 'Huertos escolares'],
         ['description' => 'Huertos comunales'],
         ['description' => 'Invernaderos'],
         ['description' => 'Consultas dentales'],
         ['description' => 'Tratamiento de caries'],
         ['description' => 'Extracción de piezas dentales'],
         ['description' => 'Jornadas de reforestación'],
         ['description' => 'Hectáreas reforestadas'],
         ['description' => 'Personas capacitadas'],
         ['description' => 'Basureros clandestinos erradicados'],
         ['description' => 'Jornadas de deschatarrización'],
         ['description' => 'Jornadas de reciclaje'],
         ['description' => 'Proceso de crianza de animales de granja'],
         ['description' => 'Jornadas'],
         ['description' => 'Diagnóstico'],
         ['description' => 'Ferias'],
      ]);
    }
}
