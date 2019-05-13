<?php

use Illuminate\Database\Seeder;

class ObjectivesSuggestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('objectives_suggests')->insert([
         ['phase'=> 1,'phase_name'=>'Inmersión comunitaria','objective_suggest'=>'Favorecer la vinculación del equipo multidisciplinario con las comunidades sujetas a intervención mediante la presentación, interacción, mediación para la aceptación de los estudiantes y los proyectos propuestos por parte de los líderes comunitarios y las comunidades en general.'],
         ['phase'=> 2,'phase_name'=>'Inserción institucional','objective_suggest'=>'Integrar de manera efectiva al equipo multidisciplinario a la sede de práctica en la exposición de roles y funciones para que puedan realizar todos sus proyectos tanto mono-disciplinarios, multidisciplinario y de convivencia comunitaria.'],
         ['phase'=> 3,'phase_name'=>'Investigación','objective_suggest'=>'Recabar información sobre las comunidades por medio de la realización de un diagnóstico participativo, aplicando los instrumentos, técnicas y fuentes de información sugeridas por el programa EPSUM para la formulación de un diagnóstico multidisciplinario científico y apegado a la realidad comunitaria.'],
         ['phase'=> 4,'phase_name'=>'Análisis de la investigación','objective_suggest'=>'Identificar las necesidades comunitarias por medio del diagnóstico participativo realizado, aplicando los instrumentos y técnicas sugeridas por el programa EPSUM para la formulación de un proyecto multidisciplinario pertinente, sostenible, sustentable y aceptado por la comunidad.'],
         ['phase'=> 5,'phase_name'=>'Planificación y diseño de proyectos','objective_suggest'=>'Establecer un plan de trabajo con objetivos claramente definidos, identificando a la población que será beneficiaria del proyecto, la localización de estos, los recursos y el tiempo necesario, así como la necesidad, problema u oportunidad que se pretende satisfacer para la realización del proyecto multidisciplinario y de convivencia comunitaria en la comunidad seleccionada.'],
         ['phase'=> 6,'phase_name'=>'Monitoreo y evaluación','objective_suggest'=>'Presentar los resultados de las intervenciones realizadas durante la práctica a las autoridades de la sede, autoridades comunitarias y a todos aquellos beneficiarios para dar por concluida la práctica.'],
      ]);
    }
}
