<?php

use Illuminate\Database\Seeder;

class MetaDisciplineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meta_discipline')->insert([
            ['metacarrer'=>	"Acuicultura"                                           ,'academic'=>	"Centro de Estudios del Mar y Acuicultura"              ,'carrer'=>	"Licenciatura en Acuicultura"                                                                   ,'incharge'=>	"ReginaValiente"],
            ['metacarrer'=>	"Técnico en Acuicultura"                                ,'academic'=>	"Centro de Estudios del Mar y Acuicultura"              ,'carrer'=>	"Técnico en Acuicultura"                                                                        ,'incharge'=>	"ReginaValiente"],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Baja Verapaz"	                ,'carrer'=>	"Ingeniero Agrónomo en Sistemas de Producción Agrícola"	                                        ,'incharge'=>	"RobertoZea"],
            ['metacarrer'=>	"Administración de Empresas"                            ,'academic'=>	"Centro Universitario de Chimaltenango"	                ,'carrer'=>	"Administración de Empresas"                              	                                    ,'incharge'=>	"Jenifer CarolinaPinzon Flores"],
            ['metacarrer'=>	"Auditoría"	                                            ,'academic'=>	"Centro Universitario de Chimaltenango"	                ,'carrer'=>	"Contaduría Pública y Auditoria"                          	                                    ,'incharge'=>	"Jenifer CarolinaPinzon Flores"	],
            ['metacarrer'=>	"Pedagogía"                                         	,'academic'=>	"Centro Universitario de Chimaltenango"	                ,'carrer'=>	"Licenciatura en Pedagogía y Administración Educativa"	                                        ,'incharge'=>	"Jenifer CarolinaPinzon Flores"	],
            ['metacarrer'=>	"Pedagogía"	                                            ,'academic'=>	"Centro Universitario de Chimaltenango"	                ,'carrer'=>	"Licenciatura en Pedagogía y Administración Educativa"	                                        ,'incharge'=>	"Jenifer CarolinaPinzon Flores"	],
            ['metacarrer'=>	"Turismo"	                                            ,'academic'=>	"Centro Universitario de Chimaltenango"	                ,'carrer'=>	"Licenciatura en Turismo"	                                                                    ,'incharge'=>	"Jenifer CarolinaPinzon Flores"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de El Quiché"	                    ,'carrer'=>	"Ingeniería Agronómica en Sistemas de Producción Agrícola"	                                    ,'incharge'=>	"Maria VictoriaAyala Maldonado"	],
            ['metacarrer'=>	"Ingeniería Forestal"	                                ,'academic'=>	"Centro Universitario de Noroccidente"	                ,'carrer'=>	"Ingeniería Forestal"	                                                                        ,'incharge'=>	"LigiaLemus,AlfredoArias"	],
            ['metacarrer'=>	"Agronomía"                                         	,'academic'=>	"Centro Universitario de Noroccidente"	                ,'carrer'=>	"Ingeniero Agrónomo con Énfasis en Fruticultura"	                                            ,'incharge'=>	"LigiaLemus,AlfredoArias"	],
            ['metacarrer'=>	"Trabajo Social Gerencial"                          	,'academic'=>	"Centro Universitario de Noroccidente"	                ,'carrer'=>	"Licenciatura en Trabajo Social"	                                                            ,'incharge'=>	"LigiaLemus,AlfredoArias"	],
            ['metacarrer'=>	"Tecnico Agricola"                                    	,'academic'=>	"Centro Universitario de Noroccidente"	                ,'carrer'=>	"Técnico en Producción Frutícola"	                                                            ,'incharge'=>	"LigiaLemus,AlfredoArias"	],
            ['metacarrer'=>	"Trabajo Social"                                       	,'academic'=>	"Centro Universitario de Noroccidente"	                ,'carrer'=>	"Trabajador Social"	                                                                            ,'incharge'=>	"LigiaLemus,AlfredoArias"	],
            ['metacarrer'=>	"Arquitectura"                                         	,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Arquitectura"	                                                                                ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Ingeniería Agronómica en Sistemas de Producción Agrícola"	                                    ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Civil"	                                                ,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Ingeniería Civil"	                                                                            ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"IGAL"                                              	,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Ingeniería en Gestión Ambiental Local"	                                                        ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Psicología"                                           	,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Licenciatura en Psicología"	                                                                ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Trabajo Social Gerencial"                          	,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Licenciatura en Trabajo Social"	                                                            ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Medicina"	                                            ,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Medico y Cirujano"	                                                                            ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Trabajo Social"                                       	,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Trabajador Social Rural"	                                                                    ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Trabajo Social"	                                    ,'academic'=>	"Centro Universitario de Occidente"	                    ,'carrer'=>	"Trabajo Social Rural"	                                                                        ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Civil"	                                                ,'academic'=>	"Centro Universitario de Oriente"	                    ,'carrer'=>	"Ingeniería Civil"	                                                                            ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Sistemas"	                                            ,'academic'=>	"Centro Universitario de Oriente"	                    ,'carrer'=>	"Ingeniería en Ciencias y Sistemas"	                                                            ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"IGAL"	                                                ,'academic'=>	"Centro Universitario de Oriente"	                    ,'carrer'=>	"Ingeniería en Gestión Ambiental Local"	                                                        ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Industrial"	                                        ,'academic'=>	"Centro Universitario de Oriente"	                    ,'carrer'=>	"Ingeniería Industrial"	                                                                        ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Oriente"	                    ,'carrer'=>	"Ingeniero Agrónomo en Sistemas de Producción"	                                                ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Zootecnia"	                                            ,'academic'=>	"Centro Universitario de Oriente"	                    ,'carrer'=>	"Licenciatura en Zootecnia"	                                                                    ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Medicina"	                                            ,'academic'=>	"Centro Universitario de Oriente"	                    ,'carrer'=>	"Medico y Cirujano"	                                                                            ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Turismo"	                                            ,'academic'=>	"Centro Universitario de Peten"	                        ,'carrer'=>	"Licenciatura en Administración de Recursos Turísticos"	                                        ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Trabajo Social"	                                    ,'academic'=>	"Centro Universitario de Peten"	                        ,'carrer'=>	"Trabajador Social"	                                                                            ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Ingeniería Forestal"	                                ,'academic'=>	"Centro Universitario de Petén"	                        ,'carrer'=>	"Ingeniería Forestal"	                                                                        ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Petén"	                        ,'carrer'=>	"Ingeniero Agrónomo en Sistemas de Producción Agropecuaria"	                                    ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Arqueología"	                                        ,'academic'=>	"Centro Universitario de Petén"	                        ,'carrer'=>	"Licenciatura en Arqueología"	                                                                ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Licenciatura en Educación Ambiental"	                ,'academic'=>	"Centro Universitario de Petén"	                        ,'carrer'=>	"Licenciatura en Educación Ambiental"	                                                        ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Pedagogía"	                                            ,'academic'=>	"Centro Universitario de Petén"	                        ,'carrer'=>	"Licenciatura en Pedagogía y Ciencias de la Educación"	                                        ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Trabajo Social Gerencial"	                            ,'academic'=>	"Centro Universitario de Petén"	                        ,'carrer'=>	"Licenciatura en Trabajo Social"	                                                            ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Administración de Empresas"	                        ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Administración de Empresas"	                                                                ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Ingeniero Agrónomo con Orientación en Agricultura Sostenible"	                                ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Abogado"	                                            ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Licenciatura en Ciencias Juridicas y Sociales, Abogacia y Notariado"	                        ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Pedagogía"	                                            ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Licenciatura en Pedagogía y Ciencias de la Educación"	                                        ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Medicina"          	                                ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Medico y Cirujano"	                                                                            ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Pedagogía"	                                            ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Profesorado de Enseñanza Media en Pedagogía y Ciencias de la Educación"	                    ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Tecnico Agricola"	                                    ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Técnico en Producción Agrícola"	                                                            ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Trabajo Social"	                                    ,'academic'=>	"Centro Universitario de San Marcos"	                ,'carrer'=>	"Trabajador Social"	                                                                            ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Santa Rosa"	                ,'carrer'=>	"Ingeniero Agrónomo en Sistemas de Producción Agrícola"	                                        ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Administración de Empresas"	                        ,'academic'=>	"Centro Universitario de Santa Rosa"	                ,'carrer'=>	"Licenciatura en Administración de Empresas"	                                                ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Administración de Empresas"	                        ,'academic'=>	"Centro Universitario de Santa Rosa"	                ,'carrer'=>	"Técnico en Administración de Empresas"	                                                        ,'incharge'=>	"Elvis EdisonZacarías Laynes"	],
            ['metacarrer'=>	"Administración de Empresas"	                        ,'academic'=>	"Centro Universitario de Suroccidente"	                ,'carrer'=>	"Administración de Empresas"	                                                                ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"IGAL"	                                                ,'academic'=>	"Centro Universitario de Suroccidente"	                ,'carrer'=>	"Ingeniería en Gestión Ambiental Local"	                                                        ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Suroccidente"	                ,'carrer'=>	"Ingeniero Agrónomo"	                                                                        ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Comunicación"	                                        ,'academic'=>	"Centro Universitario de Suroccidente"	                ,'carrer'=>	"Licenciatura en Ciencias de la Comunicación"	                                                ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Trabajo Social Gerencial"	                            ,'academic'=>	"Centro Universitario de Suroccidente"	                ,'carrer'=>	"Licenciatura en Trabajo Social"	                                                            ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Trabajo Social"	                                    ,'academic'=>	"Centro Universitario de Suroccidente"	                ,'carrer'=>	"Trabajador Social"	                                                                            ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Suroriente"	                ,'carrer'=>	"Ingeniero Agrónomo con Orientación en el Manejo y Conservación de Suelos y Agua"	            ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Trabajo Social Gerencial"	                            ,'academic'=>	"Centro Universitario de Suroriente"	                ,'carrer'=>	"Licenciatura en Trabajo Social"	                                                            ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Zootecnia"	                                            ,'academic'=>	"Centro Universitario de Suroriente"	                ,'carrer'=>	"Licenciatura en Zootecnia"	                                                                    ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Tecnico Agricola"	                                    ,'academic'=>	"Centro Universitario de Suroriente"	                ,'carrer'=>	"Técnico en Producción Pecuaria"                                                                ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Trabajo Social"	                                    ,'academic'=>	"Centro Universitario de Suroriente"	                ,'carrer'=>	"Trabajador Social"	                                                                            ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Ingeniería Forestal"	                                ,'academic'=>	"Centro Universitario de Totonicapán"	                ,'carrer'=>	"Ingeniería Forestal"                                                                           ,'incharge'=>	"AlfredoArias"	],
            ['metacarrer'=>	"Pedagogía Interculturalidad"	                        ,'academic'=>	"Centro Universitario de Totonicapán"	                ,'carrer'=>	"Licenciatura en Pedagogía e Interculturalidad"	                                                ,'incharge'=>	"AlfredoArias"	],
            ['metacarrer'=>	"Pedagogía Ambiente"	                                ,'academic'=>	"Centro Universitario de Totonicapán"	                ,'carrer'=>	"Licenciatura en Pedagogía y Administración Educativa con Orientación en Medio Ambiente"	    ,'incharge'=>	"AlfredoArias"	],
            ['metacarrer'=>	"Ingeniería Industrias Agropecuarias y Forestales"	    ,'academic'=>	"Centro Universitario de Zacapa"	                    ,'carrer'=>	"Ingeniería en Industrias Agropecuarias y Forestales"	                                        ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario de Zacapa"	                    ,'carrer'=>	"Ingeniero Agrónomo"	                                                                        ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Psicología"	                                        ,'academic'=>	"Centro Universitario de Zacapa"	                    ,'carrer'=>	"Licenciatura en Psicología"	                                                                ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Administración de Empresas"	                        ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Administración de Empresas"	                                                                ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Ingeniería Agronómica"	                                                                        ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Civil"	                                                ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Ingeniería Civil"	                                                                            ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"IGAL"	                                                ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Ingeniería en Gestión Ambiental Local"	                                                        ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Geólogo"	                                            ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Ingeniero Geólogo"	                                                                            ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Abogado"	                                            ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Licenciatura en Ciencias Jurídicas y Sociales, Abogacia y Notariado"	                        ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Pedagogía Ambiente"	                                ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Licenciatura en Pedagogía y Administración Educativa con Orientación en Medio Ambiente"	    ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Psicología"	                                        ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Licenciatura en Psicología"	                                                                ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Psicologia"	                                        ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Psicólogo"	                                                                                    ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Trabajo Social Gerencial"	                            ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Licenciatura en Trabajo Social"	                                                            ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Zootecnia"	                                            ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Licenciatura en Zootecnia"	                                                                    ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Trabajo Social"	                                    ,'academic'=>	"Centro Universitario del Norte"	                    ,'carrer'=>	"Trabajador Social"	                                                                            ,'incharge'=>	"IngridPolanco,RobertoZea"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Centro Universitario del Quiché"	                    ,'carrer'=>	"Ingeniería Agronómica en Sistemas de Producción Agrícola"	                                    ,'incharge'=>	"Maria VictoriaAyala Maldonado"	],
            ['metacarrer'=>	"Medicina"	                                            ,'academic'=>	"Centro Universitario del Sur"	                        ,'carrer'=>	"Medico y Cirujano"	                                                                            ,'incharge'=>	"MaxCastillo"	],
            ['metacarrer'=>	"Política"	                                            ,'academic'=>	"Escuela de Ciencia Política"	                        ,'carrer'=>	"Licenciatura en Ciencia Política"	                                                            ,'incharge'=>	"MaxCastillo"	],
            ['metacarrer'=>	"Relaciones Internacionales"	                        ,'academic'=>	"Escuela de Ciencia Política"	                        ,'carrer'=>	"Licenciatura en Relaciones Internacionales"	                                                ,'incharge'=>	"MaxCastillo"	],
            ['metacarrer'=>	"Sociología"	                                        ,'academic'=>	"Escuela de Ciencia Política"	                        ,'carrer'=>	"Licenciatura en Sociología"	                                                                ,'incharge'=>	"MaxCastillo"	],
            ['metacarrer'=>	"Comunicación"	                                        ,'academic'=>	"Escuela de Ciencias de la Comunicación"	            ,'carrer'=>	"Licenciatura en Ciencias de la Comunicación"	                                                ,'incharge'=>	"IngridPolanco"	],
            ['metacarrer'=>	"Psicología"	                                        ,'academic'=>	"Escuela de Ciencias Psicológicas"	                    ,'carrer'=>	"Licenciatura en Psicología"	                                                                ,'incharge'=>	"Jenifer CarolinaPinzon Flores"	],
            ['metacarrer'=>	"Psicologia"	                                        ,'academic'=>	"Escuela de Ciencias Psicológicas"	                    ,'carrer'=>	"Profesorado en Educación Especial"	                                                            ,'incharge'=>	"Jenifer CarolinaPinzon Flores"	],
            ['metacarrer'=>	"Trabajo Social Gerencial"	                            ,'academic'=>	"Escuela de Trabajo Social"	                            ,'carrer'=>	"Licenciatura en Trabajo Social"	                                                            ,'incharge'=>	"IngridPolanco"	],
            ['metacarrer'=>	"Artes actuación"	                                    ,'academic'=>	"Escuela Superior de Arte"	                            ,'carrer'=>	"Licenciatura en Arte Dramático con Especialización en Actuación"	                            ,'incharge'=>	"IngridPolanco"	],
            ['metacarrer'=>	"Artes Pintura"	                                        ,'academic'=>	"Escuela Superior de Arte"	                            ,'carrer'=>	"Licenciatura en Artes Visuales con Especialización en Pintura"	                                ,'incharge'=>	"IngridPolanco"	],
            ['metacarrer'=>	"Artes Musica"	                                        ,'academic'=>	"Escuela Superior de Arte"	                            ,'carrer'=>	"Licenciatura en Música"	                                                                    ,'incharge'=>	"IngridPolanco"	],
            ['metacarrer'=>	"Agronomía RNR"	                                        ,'academic'=>	"Facultad de Agronomía"	                                ,'carrer'=>	"Ingeniería Agronómica en Recursos Naturales Renovables"	                                    ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Agronomía"	                                            ,'academic'=>	"Facultad de Agronomía"	                                ,'carrer'=>	"Ingeniería Agronómica en Sistemas de Producción Agrícola"	                                    ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"IGAL"	                                                ,'academic'=>	"Facultad de Agronomía"	                                ,'carrer'=>	"Ingeniería en Gestión Ambiental Local"	                                                        ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Ingeniería Industrias Agropecuarias y Forestales"	    ,'academic'=>	"Facultad de Agronomía"	                                ,'carrer'=>	"Ingeniería en Industrias Agropecuarias y Forestales"	                                        ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Arquitectura"	                                        ,'academic'=>	"Facultad de Arquitectura"	                            ,'carrer'=>	"Arquitectura"  	                                                                            ,'incharge'=>	"MaxCastillo"	],
            ['metacarrer'=>	"Medicina"	                                            ,'academic'=>	"Facultad de Ciencias Médicas"	                        ,'carrer'=>	"Medico y Cirujano"	                                                                            ,'incharge'=>	"ReginaValiente"	],
            ['metacarrer'=>	"Biología"	                                            ,'academic'=>	"Facultad de Ciencias Químicas y Farmacia"	            ,'carrer'=>	"Biología"	                                                                                    ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Nutrición"	                                            ,'academic'=>	"Facultad de Ciencias Químicas y Farmacia"	            ,'carrer'=>	"Nutricion"	                                                                                    ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Química"	                                            ,'academic'=>	"Facultad de Ciencias Químicas y Farmacia"	            ,'carrer'=>	"Química"	                                                                                    ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Química Biológica"	                                    ,'academic'=>	"Facultad de Ciencias Químicas y Farmacia"	            ,'carrer'=>	"Química Biológica"	                                                                            ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Química Farmacéutica"	                                ,'academic'=>	"Facultad de Ciencias Químicas y Farmacia"	            ,'carrer'=>	"Química Farmacéutica"	                                                                        ,'incharge'=>	"Luisa FernandaRodríuguez Cuevas"	],
            ['metacarrer'=>	"Pedagogía"	                                            ,'academic'=>	"Facultad de Humanidades"	                            ,'carrer'=>	"Licenciatura en Pedagogía y Administración Educativa"	                                        ,'incharge'=>	"Flor de AbrilEstrada Orantes"	],
            ['metacarrer'=>	"Pedagogía"	                                            ,'academic'=>	"Facultad de Humanidades"	                            ,'carrer'=>	"Licenciatura en Pedagogía y Derechos Humanos"	                                                ,'incharge'=>	"Flor de AbrilEstrada Orantes"	],
            ['metacarrer'=>	"Civil"	                                                ,'academic'=>	"Facultad de Ingeniería"	                            ,'carrer'=>	"Ingeniería Civil"	                                                                            ,'incharge'=>	"JenniferLópez"	],
            ['metacarrer'=>	"Industrial"	                                        ,'academic'=>	"Facultad de Ingeniería"	                            ,'carrer'=>	"Ingeniería Industrial"	                                                                        ,'incharge'=>	"JenniferLópez"	],
            ['metacarrer'=>	"Mecánica"	                                            ,'academic'=>	"Facultad de Ingeniería"	                            ,'carrer'=>	"Ingeniería Mecánica"	                                                                        ,'incharge'=>	"JenniferLópez"	],
            ['metacarrer'=>	"Mecanico-Industrial"	                                ,'academic'=>	"Facultad de Ingeniería"	                            ,'carrer'=>	"Ingeniería Mecánica Industrial"	                                                            ,'incharge'=>	"JenniferLópez"	],
            ['metacarrer'=>	"Veterinaria"	                                        ,'academic'=>	"Facultad de Medicina Veterinaria y Zootecnia"	        ,'carrer'=>	"Medicina Veterinaria"	                                                                        ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Zootecnia"	                                            ,'academic'=>	"Facultad de Medicina Veterinaria y Zootecnia"	        ,'carrer'=>	"Zootecnia"	                                                                                    ,'incharge'=>	"Alberto EnriqueAlvarado Cerezo"	],
            ['metacarrer'=>	"Odontología"	                                        ,'academic'=>	"Facultad de Odontología"	                            ,'carrer'=>	"Cirujano Dentista"	                                                                            ,'incharge'=>	"IngridPolanco"	],
        ]);
    }
}