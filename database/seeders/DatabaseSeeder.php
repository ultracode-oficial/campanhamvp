<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::firstOrCreate(["name" => "Victor Mussel"], [
            'name' => 'Victor Mussel',
            'email' => 'victor.mussel@hotmail.com',
            'nivel' => 'Super-Admin',
            'password' => 'teste123', //'$2y$10$eMMXLkP579E/hf8.oSBJRu.yndQDIU0XrjRsY/R9Sr6hxzjToy0gC', 
        ]);

        // JSON Locais Eleitorais + Zonas e Seções.
        $locais_eleitorais = json_decode('[
            {
                "zona": "83",
                "secoes": [
                    {"numero":"226","eleitores_aptos":297},
                    {"numero":"231","eleitores_aptos":311},
                    {"numero":"237","eleitores_aptos":200}
                ],
                "nome_local": "ESCOLA MUNICIPAL SAMUEL DE SOUZA MACIEL",
                "logradouro": "RUA PROFESSOR SAMUEL DE SOUZA MACIEL",
                "numero_logradouro": "86",
                "municipio": "MESQUITA",
                "bairro": "PARQUE SENADOR",
                "cep": "26551130",
                "uf": "RJ",
                "lat": -22.7775624,
                "lng": -43.4250922
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"79","eleitores_aptos":389},
                    {"numero":"80","eleitores_aptos":390},
                    {"numero":"81","eleitores_aptos":396},
                    {"numero":"82","eleitores_aptos":391},
                    {"numero":"83","eleitores_aptos":394},
                    {"numero":"84","eleitores_aptos":391},
                    {"numero":"85","eleitores_aptos":423},
                    {"numero":"86","eleitores_aptos":393},
                    {"numero":"87","eleitores_aptos":394},
                    {"numero":"88","eleitores_aptos":392},
                    {"numero":"182","eleitores_aptos":390},
                    {"numero":"211","eleitores_aptos":390},
                    {"numero":"217","eleitores_aptos":389},
                    {"numero":"221","eleitores_aptos":395},
                    {"numero":"247","eleitores_aptos":392}
                ],
                "nome_local": "COLÉGIO ESTADUAL BRASIL",
                "logradouro": "RUA MANOEL AFONSO",
                "numero_logradouro": "55",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26551550",
                "uf": "RJ",
                "lat": -22.7836438,
                "lng": -43.4272409
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"59","eleitores_aptos":342},
                    {"numero":"60","eleitores_aptos":341},
                    {"numero":"61","eleitores_aptos":344},
                    {"numero":"62","eleitores_aptos":338},
                    {"numero":"63","eleitores_aptos":344},
                    {"numero":"64","eleitores_aptos":340},
                    {"numero":"65","eleitores_aptos":343},
                    {"numero":"194","eleitores_aptos":342}
                ],
                "nome_local": "CIEP SÃO FRANCISCO DE ASSIS",
                "logradouro": "AVENIDA TREZE DE MAIO",
                "numero_logradouro": "44",
                "municipio": "MESQUITA",
                "bairro": "ROCHA SOBRINHO",
                "cep": "26550007",
                "uf": "RJ",
                "lat": -22.7789482,
                "lng": -43.3991849
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"167","eleitores_aptos":396},
                    {"numero":"179","eleitores_aptos":394},
                    {"numero":"209","eleitores_aptos":393},
                    {"numero":"244","eleitores_aptos":392},
                    {"numero":"252","eleitores_aptos":397},
                    {"numero":"276","eleitores_aptos":390},
                    {"numero":"280","eleitores_aptos":389},
                    {"numero":"285","eleitores_aptos":388},
                    {"numero":"291","eleitores_aptos":391},
                    {"numero":"295","eleitores_aptos":387},
                    {"numero":"307","eleitores_aptos":392},
                    {"numero":"311","eleitores_aptos":409},
                    {"numero":"322","eleitores_aptos":391},
                    {"numero":"329","eleitores_aptos":388},
                    {"numero":"337","eleitores_aptos":389}
                ],
                "nome_local": "ESCOLA MUNICIPAL DEOCLÉCIO DIAS MACHADO FILHO",
                "logradouro": "RUA CARLOS FRAHIA",
                "numero_logradouro": "101",
                "municipio": "MESQUITA",
                "bairro": "COSMORAMA",
                "cep": "26582020",
                "uf": "RJ",
                "lat": -22.7920618,
                "lng": -43.4172443
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"6","eleitores_aptos":353},
                    {"numero":"7","eleitores_aptos":347},
                    {"numero":"8","eleitores_aptos":358},
                    {"numero":"9","eleitores_aptos":355},
                    {"numero":"10","eleitores_aptos":354},
                    {"numero":"11","eleitores_aptos":357},
                    {"numero":"169","eleitores_aptos":356},
                    {"numero":"207","eleitores_aptos":354},
                    {"numero":"234","eleitores_aptos":350},
                    {"numero":"290","eleitores_aptos":351},
                    {"numero":"297","eleitores_aptos":354},
                    {"numero":"303","eleitores_aptos":352},
                    {"numero":"323","eleitores_aptos":353},
                    {"numero":"330","eleitores_aptos":352},
                    {"numero":"336","eleitores_aptos":356}
                ],
                "nome_local": "ESCOLA MUNICIPAL AMÉRICO DOS SANTOS",
                "logradouro": "RUA VOLTAIRE",
                "numero_logradouro": "75",
                "municipio": "MESQUITA",
                "bairro": "BANCO DE AREIA",
                "cep": "26570060",
                "uf": "RJ",
                "lat": -22.7782368,
                "lng": -43.4158886
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"4","eleitores_aptos":389},
                    {"numero":"5","eleitores_aptos":383},
                    {"numero":"193","eleitores_aptos":391},
                    {"numero":"238","eleitores_aptos":390},
                    {"numero":"267","eleitores_aptos":392},
                    {"numero":"279","eleitores_aptos":389},
                    {"numero":"288","eleitores_aptos":389},
                    {"numero":"292","eleitores_aptos":402},
                    {"numero":"294","eleitores_aptos":388},
                    {"numero":"298","eleitores_aptos":391},
                    {"numero":"301","eleitores_aptos":390},
                    {"numero":"308","eleitores_aptos":388},
                    {"numero":"321","eleitores_aptos":387},
                    {"numero":"326","eleitores_aptos":386},
                    {"numero":"342","eleitores_aptos":390}
                ],
                "nome_local": "CIEP 111 - GELSON FREITAS",
                "logradouro": "RUA RICARDO",
                "numero_logradouro": "0",
                "municipio": "MESQUITA",
                "bairro": "SANTO ELIAS",
                "cep": "26562030",
                "uf": "RJ",
                "lat": -22.771096,
                "lng": -43.4245866
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"107","eleitores_aptos":382},
                    {"numero":"108","eleitores_aptos":369},
                    {"numero":"109","eleitores_aptos":376},
                    {"numero":"110","eleitores_aptos":372},
                    {"numero":"111","eleitores_aptos":371},
                    {"numero":"112","eleitores_aptos":371},
                    {"numero":"170","eleitores_aptos":368},
                    {"numero":"270","eleitores_aptos":371}
                ],
                "nome_local": "ESCOLA ESTADUAL MUNICIPALIZADA SANTOS DUMONT",
                "logradouro": "RUA CESÁRIO",
                "numero_logradouro": "276",
                "municipio": "MESQUITA",
                "bairro": "BANCO DE AREIA",
                "cep": "26570442",
                "uf": "RJ",
                "lat": -22.7776624,
                "lng": -43.4207067
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"41","eleitores_aptos":343},
                    {"numero":"42","eleitores_aptos":346},
                    {"numero":"127","eleitores_aptos":347},
                    {"numero":"128","eleitores_aptos":344},
                    {"numero":"129","eleitores_aptos":347},
                    {"numero":"130","eleitores_aptos":346},
                    {"numero":"131","eleitores_aptos":347},
                    {"numero":"132","eleitores_aptos":350},
                    {"numero":"133","eleitores_aptos":346},
                    {"numero":"134","eleitores_aptos":345},
                    {"numero":"135","eleitores_aptos":349},
                    {"numero":"206","eleitores_aptos":344},
                    {"numero":"242","eleitores_aptos":347},
                    {"numero":"250","eleitores_aptos":346},
                    {"numero":"257","eleitores_aptos":346},
                    {"numero":"260","eleitores_aptos":353},
                    {"numero":"262","eleitores_aptos":348},
                    {"numero":"283","eleitores_aptos":349}
                ],
                "nome_local": "CIEP 364 - NELSON RAMOS",
                "logradouro": "RUA PAULO",
                "numero_logradouro": "s/n",
                "municipio": "MESQUITA",
                "bairro": "VILA EMIL",
                "cep": "26551240",
                "uf": "RJ",
                "lat": -22.7822136,
                "lng": -43.4245064
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"222","eleitores_aptos":350},
                    {"numero":"224","eleitores_aptos":353},
                    {"numero":"282","eleitores_aptos":348},
                    {"numero":"293","eleitores_aptos":351},
                    {"numero":"299","eleitores_aptos":353},
                    {"numero":"310","eleitores_aptos":366},
                    {"numero":"317","eleitores_aptos":353},
                    {"numero":"327","eleitores_aptos":350},
                    {"numero":"338","eleitores_aptos":354},
                    {"numero":"344","eleitores_aptos":246}
                ],
                "nome_local": "ESCOLA MUNICIPAL PRESIDENTE CASTELO BRANCO",
                "logradouro": "AVENIDA PRESIDENTE KENNEDY",
                "numero_logradouro": "s/n",
                "municipio": "MESQUITA",
                "bairro": "ROCHA SOBRINHO",
                "cep": "26574640",
                "uf": "RJ",
                "lat": -22.7791714,
                "lng": -43.4014977
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"136","eleitores_aptos":301},
                    {"numero":"137","eleitores_aptos":304},
                    {"numero":"138","eleitores_aptos":305},
                    {"numero":"183","eleitores_aptos":302},
                    {"numero":"249","eleitores_aptos":302}
                ],
                "nome_local": "CENTRO COMUNITÁRIO PADRE DANIEL",
                "logradouro": "RUA JEREMIAS",
                "numero_logradouro": "38",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26551470",
                "uf": "RJ",
                "lat": -22.7845342,
                "lng": -43.42725
            },
            {
                "zona": "83",
                "secoes": [
                        {"numero": 119, "eleitores_aptos": 369},
                        {"numero": 120, "eleitores_aptos": 386},
                        {"numero": 174, "eleitores_aptos": 374},
                        {"numero": 190, "eleitores_aptos": 372},
                        {"numero": 229, "eleitores_aptos": 376}
                    ],
                "nome_local": "IGREJA NOSSA SENHORA DE FÁTIMA",
                "logradouro": "AVENIDA GOVERNADOR CELSO PEÇANHA",
                "numero_logradouro": "1275",
                "municipio": "MESQUITA",
                "bairro": "ROCHA SOBRINHO",
                "cep": "26570000",
                "uf": "RJ",
                "lat": -22.7774156,
                "lng": -43.4162275
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"139","eleitores_aptos":342},
                    {"numero":"140","eleitores_aptos":343},
                    {"numero":"141","eleitores_aptos":344},
                    {"numero":"186","eleitores_aptos":345},
                    {"numero":"201","eleitores_aptos":343},
                    {"numero":"216","eleitores_aptos":340}
                ],
                "nome_local": "COLÉGIO INFANTIL GENTE GRANDE",
                "logradouro": "RUA HERCÍLIA",
                "numero_logradouro": "906",
                "municipio": "MESQUITA",
                "bairro": "VILA EMIL",
                "cep": "26580131",
                "uf": "RJ",
                "lat": -22.7836811,
                "lng": -43.4254346
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"113","eleitores_aptos":395},
                    {"numero":"114","eleitores_aptos":394},
                    {"numero":"115","eleitores_aptos":395},
                    {"numero":"116","eleitores_aptos":414},
                    {"numero":"117","eleitores_aptos":393},
                    {"numero":"118","eleitores_aptos":394},
                    {"numero":"199","eleitores_aptos":395},
                    {"numero":"210","eleitores_aptos":394},
                    {"numero":"215","eleitores_aptos":399},
                    {"numero":"246","eleitores_aptos":394},
                    {"numero":"264","eleitores_aptos":392},
                    {"numero":"275","eleitores_aptos":394},
                    {"numero":"278","eleitores_aptos":395},
                    {"numero":"284","eleitores_aptos":396},
                    {"numero":"316","eleitores_aptos":391}
                ],
                "nome_local": "COLÉGIO ESTADUAL VILA BELA",
                "logradouro": "RUA TIBIRIÇA",
                "numero_logradouro": "285",
                "municipio": "MESQUITA",
                "bairro": "BANCO DE AREIA",
                "cep": "26574760",
                "uf": "RJ",
                "lat": -22.7803481,
                "lng": -43.4099067
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"289","eleitores_aptos":350},
	                {"numero":"296","eleitores_aptos":345}
                ],
                "nome_local": "COMUNIDADE SÃO SEBASTIÃO",
                "logradouro": "RUA CAPITÃO TELES",
                "numero_logradouro": "192",
                "municipio": "MESQUITA",
                "bairro": "CRUZEIRO DO SUL",
                "cep": "26235630",
                "uf": "RJ",
                "lat": -22.7789006,
                "lng": -43.42798
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"300","eleitores_aptos":324},
	                {"numero":"314","eleitores_aptos":325},
	                {"numero":"332","eleitores_aptos":322}
                ],
                "nome_local": "ESCOLA MUNICIPAL CRUZEIRO DO SUL",
                "logradouro": "RUA ELPÍDIO",
                "numero_logradouro": "132",
                "municipio": "MESQUITA",
                "bairro": "CRUZEIRO DO SUL",
                "cep": "26551061",
                "uf": "RJ",
                "lat": -22.7781024,
                "lng": -43.4272777
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"302","eleitores_aptos":381},
                    {"numero":"312","eleitores_aptos":361},
                    {"numero":"324","eleitores_aptos":371},
                    {"numero":"335","eleitores_aptos":370},
                    {"numero":"343","eleitores_aptos":355},
                    {"numero":"347","eleitores_aptos":21}
                ],
                "nome_local": "CIEP PADRE NINO MIRALDI",
                "logradouro": "RUA GUARANI",
                "numero_logradouro": "200",
                "municipio": "MESQUITA",
                "bairro": "JACUTINGA",
                "cep": "26013150",
                "uf": "RJ",
                "lat": -22.769114,
                "lng": -43.4152
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"54","eleitores_aptos":394},
                    {"numero":"55","eleitores_aptos":394},
                    {"numero":"56","eleitores_aptos":389},
                    {"numero":"306","eleitores_aptos":387}
                ],
                "nome_local": "ASSEMBLÉIA DE DEUS DE COSMORAMA",
                "logradouro": "RUA COSMORAMA",
                "numero_logradouro": "2100",
                "municipio": "MESQUITA",
                "bairro": "COSMORAMA",
                "cep": "26582020",
                "uf": "RJ",
                "lat": -22.7907661,
                "lng": -43.4126065
            },
            {
                "zona": "83",
                "secoes": [
                     {"numero":"319","eleitores_aptos":208},
                    {"numero":"320","eleitores_aptos":320},
                    {"numero":"325","eleitores_aptos":310},
                    {"numero":"331","eleitores_aptos":333}
                ],
                "nome_local": "ESCOLA MUNICIPAL EXPEDITO MIGUEL",
                "logradouro": "RUA ELPÍDIO",
                "numero_logradouro": "1370",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26580121",
                "uf": "RJ",
                "lat": -22.7892648,
                "lng": -43.422384
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"52","eleitores_aptos":347},
	                {"numero":"53","eleitores_aptos":350}
                ],
                "nome_local": "COMUNIDADE BÍBLICA BETEL",
                "logradouro": "RUA CÉLIO DE AZEVEDO",
                "numero_logradouro": "187",
                "municipio": "MESQUITA",
                "bairro": "VILA NORMA",
                "cep": "26572400",
                "uf": "RJ",
                "lat": -22.7882598,
                "lng": -43.4095336
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"304","eleitores_aptos":328},
                    {"numero":"309","eleitores_aptos":329},
                    {"numero":"313","eleitores_aptos":330},
                    {"numero":"328","eleitores_aptos":330},
                    {"numero":"340","eleitores_aptos":327}
                ],
                "nome_local": "COLEGIO GERAÇÃO FELIZ",
                "logradouro": "RUA ZOÉ",
                "numero_logradouro": "81",
                "municipio": "MESQUITA",
                "bairro": "PRESIDENTE JUSCELINO",
                "cep": "26550130",
                "uf": "RJ",
                "lat": -22.7832495,
                "lng": -43.4302005
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"12","eleitores_aptos":394},
                    {"numero":"13","eleitores_aptos":382},
                    {"numero":"14","eleitores_aptos":380},
                    {"numero":"305","eleitores_aptos":385},
                    {"numero":"318","eleitores_aptos":389},
                    {"numero":"346","eleitores_aptos":188}
                ],
                "nome_local": "COMUNIDADE SÃO NICOLAU",
                "logradouro": "RUA COSMORAMA",
                "numero_logradouro": "940",
                "municipio": "MESQUITA",
                "bairro": "COSMORAMA",
                "cep": "26582020",
                "uf": "RJ",
                "lat": -22.7925468,
                "lng": -43.4156438
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"333","eleitores_aptos":155},
	                {"numero":"341","eleitores_aptos":154}
                ],
                "nome_local": "IGREJA BATISTA BETEL DE MESQUITA",
                "logradouro": "RUA EGÍDIO",
                "numero_logradouro": "979",
                "municipio": "MESQUITA",
                "bairro": "EDSON PASSOS",
                "cep": "26235100",
                "uf": "RJ",
                "lat": -22.7850434,
                "lng": -43.4230994
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"334","eleitores_aptos":322},
	                {"numero":"339","eleitores_aptos":249}
                ],
                "nome_local": "IGREJA PRESBITERIANA DO BAIRRO SANTO ELIAS",
                "logradouro": "RUA SOTERO",
                "numero_logradouro": "267",
                "municipio": "MESQUITA",
                "bairro": "SANTO ELIAS",
                "cep": "26560480",
                "uf": "RJ",
                "lat": -22.7760921,
                "lng": -43.4213402
            },
            {
                "zona": "83",
                "secoes": [
                    {"numero":"166","eleitores_aptos":377},
                    {"numero":"191","eleitores_aptos":367},
                    {"numero":"243","eleitores_aptos":372},
                    {"numero":"277","eleitores_aptos":370},
                    {"numero":"281","eleitores_aptos":379},
                    {"numero":"286","eleitores_aptos":377},
                    {"numero":"287","eleitores_aptos":369},
                    {"numero":"315","eleitores_aptos":374},
                    {"numero":"345","eleitores_aptos":11}
                ],
                "nome_local": "ESCOLA MUNICIPAL PROFESSOR QUIRINO",
                "logradouro": "RUA LUCIANO",
                "numero_logradouro": "151",
                "municipio": "MESQUITA",
                "bairro": "SANTO ELIAS",
                "cep": "26562070",
                "uf": "RJ",
                "lat": -22.7664087,
                "lng": -43.422956
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"115","eleitores_aptos":331},
                    {"numero":"116","eleitores_aptos":326},
                    {"numero":"117","eleitores_aptos":329},
                    {"numero":"118","eleitores_aptos":337},
                    {"numero":"119","eleitores_aptos":339},
                    {"numero":"120","eleitores_aptos":335},
                    {"numero":"121","eleitores_aptos":344},
                    {"numero":"159","eleitores_aptos":379},
                    {"numero":"160","eleitores_aptos":389},
                    {"numero":"161","eleitores_aptos":385},
                    {"numero":"162","eleitores_aptos":378},
                    {"numero":"163","eleitores_aptos":387},
                    {"numero":"164","eleitores_aptos":379},
                    {"numero":"179","eleitores_aptos":383},
                    {"numero":"214","eleitores_aptos":393}
                ],
                "nome_local": "COLEGIO MACHADO DE ASSIS",
                "logradouro": "AVENIDA UNIAO",
                "numero_logradouro": "535",
                "municipio": "MESQUITA",
                "bairro": "ALTO URUGUAI",
                "cep": "26554000",
                "uf": "RJ",
                "lat": -22.792119,
                "lng": -43.4362
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"148","eleitores_aptos":373},
                    {"numero":"149","eleitores_aptos":377},
                    {"numero":"150","eleitores_aptos":374},
                    {"numero":"151","eleitores_aptos":374},
                    {"numero":"152","eleitores_aptos":362}
                ],
                "nome_local": "COMUNIDADE SÃO MARCOS",
                "logradouro": "AVENIDA MANOEL DUARTE",
                "numero_logradouro": "383",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26553280",
                "uf": "RJ",
                "lat": -22.7897878,
                "lng": -43.4298599
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"138","eleitores_aptos":349},
                    {"numero":"139","eleitores_aptos":345},
                    {"numero":"140","eleitores_aptos":348},
                    {"numero":"141","eleitores_aptos":345}
                ],
                "nome_local": "COMUNIDADE SÃO MATEUS",
                "logradouro": "RUA SERRA",
                "numero_logradouro": "12",
                "municipio": "MESQUITA",
                "bairro": "SANTA TEREZINHA",
                "cep": "26554040",
                "uf": "RJ",
                "lat": -22.7890393,
                "lng": -43.4359393
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"122","eleitores_aptos":377},
                    {"numero":"123","eleitores_aptos":375},
                    {"numero":"124","eleitores_aptos":383},
                    {"numero":"125","eleitores_aptos":381},
                    {"numero":"126","eleitores_aptos":385},
                    {"numero":"127","eleitores_aptos":381},
                    {"numero":"128","eleitores_aptos":380},
                    {"numero":"129","eleitores_aptos":380},
                    {"numero":"130","eleitores_aptos":382},
                    {"numero":"131","eleitores_aptos":381}
                ],
                "nome_local": "CIEP POETA MARIO QUINTANA",
                "logradouro": "RUA INACIO SERRA",
                "numero_logradouro": "s/n",
                "municipio": "MESQUITA",
                "bairro": "CHATUBA",
                "cep": "26587590",
                "uf": "RJ",
                "lat": -22.8086988,
                "lng": -43.43994
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"76","eleitores_aptos":353},
                    {"numero":"77","eleitores_aptos":365},
                    {"numero":"78","eleitores_aptos":356},
                    {"numero":"79","eleitores_aptos":358},
                    {"numero":"80","eleitores_aptos":353},
                    {"numero":"81","eleitores_aptos":362},
                    {"numero":"82","eleitores_aptos":357},
                    {"numero":"83","eleitores_aptos":352},
                    {"numero":"84","eleitores_aptos":365},
                    {"numero":"85","eleitores_aptos":355},
                    {"numero":"86","eleitores_aptos":360},
                    {"numero":"87","eleitores_aptos":356},
                    {"numero":"88","eleitores_aptos":360},
                    {"numero":"171","eleitores_aptos":361},
                    {"numero":"200","eleitores_aptos":371},
                    {"numero":"202","eleitores_aptos":358}
                ],
                "nome_local": "GRUPO ESCOLAR DOM PEDRO I",
                "logradouro": "AVENIDA MANOEL DUARTE",
                "numero_logradouro": "1215",
                "municipio": "MESQUITA",
                "bairro": "SANTA TEREZINHA",
                "cep": "26554161",
                "uf": "RJ",
                "lat": -22.7915036,
                "lng": -43.4371778
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"112","eleitores_aptos":308},
                    {"numero":"113","eleitores_aptos":308},
                    {"numero":"114","eleitores_aptos":309},
                    {"numero":"167","eleitores_aptos":308},
                    {"numero":"173","eleitores_aptos":309},
                    {"numero":"192","eleitores_aptos":304},
                    {"numero":"205","eleitores_aptos":307}
                ],
                "nome_local": "IGREJA DO NAZARENO",
                "logradouro": "AVENIDA UNIAO",
                "numero_logradouro": "1400",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26554155",
                "uf": "RJ",
                "lat": -22.7848725,
                "lng": -43.4330941
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"59","eleitores_aptos":348},
                    {"numero":"60","eleitores_aptos":342},
                    {"numero":"61","eleitores_aptos":346},
                    {"numero":"62","eleitores_aptos":345},
                    {"numero":"63","eleitores_aptos":350},
                    {"numero":"64","eleitores_aptos":346},
                    {"numero":"65","eleitores_aptos":346},
                    {"numero":"66","eleitores_aptos":347},
                    {"numero":"67","eleitores_aptos":345},
                    {"numero":"68","eleitores_aptos":341},
                    {"numero":"198","eleitores_aptos":350},
                    {"numero":"207","eleitores_aptos":346},
                    {"numero":"216","eleitores_aptos":141}
                ],
                "nome_local": "GINÁSIO VOCACIONAL PRESIDENTE CASTELO BRANCO",
                "logradouro": "PRAÇA PORTO ALEGRE",
                "numero_logradouro": "105",
                "municipio": "MESQUITA",
                "bairro": "PRESIDENTE JUSCELINO",
                "cep": "26553333",
                "uf": "RJ",
                "lat": -22.7727543,
                "lng": -43.4345177
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"48","eleitores_aptos":280},
                    {"numero":"49","eleitores_aptos":283},
                    {"numero":"50","eleitores_aptos":283},
                    {"numero":"51","eleitores_aptos":285},
                    {"numero":"52","eleitores_aptos":280},
                    {"numero":"53","eleitores_aptos":283},
                    {"numero":"54","eleitores_aptos":278},
                    {"numero":"55","eleitores_aptos":282},
                    {"numero":"56","eleitores_aptos":281},
                    {"numero":"57","eleitores_aptos":282},
                    {"numero":"58","eleitores_aptos":280},
                    {"numero":"145","eleitores_aptos":282},
                    {"numero":"185","eleitores_aptos":280}
                ],
                "nome_local": "ESCOLA MUNICIPAL ROTARIANO ARTHUR SILVA",
                "logradouro": "RUA PARANA",
                "numero_logradouro": "443",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26553020",
                "uf": "RJ",
                "lat": -22.7783172,
                "lng": -43.4326943
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"34","eleitores_aptos":357},
                    {"numero":"35","eleitores_aptos":345},
                    {"numero":"36","eleitores_aptos":346},
                    {"numero":"37","eleitores_aptos":346},
                    {"numero":"38","eleitores_aptos":343},
                    {"numero":"39","eleitores_aptos":342},
                    {"numero":"40","eleitores_aptos":342},
                    {"numero":"41","eleitores_aptos":344},
                    {"numero":"42","eleitores_aptos":341},
                    {"numero":"43","eleitores_aptos":346},
                    {"numero":"211","eleitores_aptos":338}
                ],
                "nome_local": "ESCOLA MUNICIPAL ROBERTO SILVEIRA",
                "logradouro": "PRAÇA DARCY RIBEIRO",
                "numero_logradouro": "150",
                "municipio": "MESQUITA",
                "bairro": "EDSON PASSOS",
                "cep": "26584150",
                "uf": "RJ",
                "lat": -22.7963194,
                "lng": -43.4234116
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"23","eleitores_aptos":376},
                    {"numero":"24","eleitores_aptos":375},
                    {"numero":"25","eleitores_aptos":375},
                    {"numero":"26","eleitores_aptos":371},
                    {"numero":"27","eleitores_aptos":375},
                    {"numero":"28","eleitores_aptos":369},
                    {"numero":"29","eleitores_aptos":374},
                    {"numero":"30","eleitores_aptos":373},
                    {"numero":"31","eleitores_aptos":372},
                    {"numero":"32","eleitores_aptos":372},
                    {"numero":"33","eleitores_aptos":369},
                    {"numero":"168","eleitores_aptos":374},
                    {"numero":"176","eleitores_aptos":378},
                    {"numero":"195","eleitores_aptos":373}
                ],
                "nome_local": "COLEGIO MANOEL REIS",
                "logradouro": "RUA PREFEITO JOSE MONTES PAIXAO",
                "numero_logradouro": "700",
                "municipio": "MESQUITA",
                "bairro": "EDSON PASSOS",
                "cep": "26584021",
                "uf": "RJ",
                "lat": -22.7939279,
                "lng": -43.426316
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"12","eleitores_aptos":382},
                    {"numero":"13","eleitores_aptos":390},
                    {"numero":"14","eleitores_aptos":385},
                    {"numero":"15","eleitores_aptos":389},
                    {"numero":"16","eleitores_aptos":393},
                    {"numero":"17","eleitores_aptos":383},
                    {"numero":"18","eleitores_aptos":394},
                    {"numero":"19","eleitores_aptos":386},
                    {"numero":"210","eleitores_aptos":385},
                    {"numero":"217","eleitores_aptos":186}
                ],
                "nome_local": "COLEGIO ESTADUAL PIERRE PLANCHER",
                "logradouro": "RUA ABEL DE ALVARENGA",
                "numero_logradouro": "s/n",
                "municipio": "MESQUITA",
                "bairro": "CHATUBA",
                "cep": "26585000",
                "uf": "RJ",
                "lat": -22.7998684,
                "lng": -43.4355411
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"6","eleitores_aptos":303},
                    {"numero":"7","eleitores_aptos":301},
                    {"numero":"8","eleitores_aptos":304},
                    {"numero":"9","eleitores_aptos":302},
                    {"numero":"10","eleitores_aptos":303},
                    {"numero":"11","eleitores_aptos":305}
                ],
                "nome_local": "CENTRO EDUCACIONAL ARTE E VIDA",
                "logradouro": "RUA BARÃO DE SALUSSE",
                "numero_logradouro": "1845",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26240130",
                "uf": "RJ",
                "lat": -22.7853106,
                "lng": -43.4325323
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"1","eleitores_aptos":236},
                    {"numero":"2","eleitores_aptos":235},
                    {"numero":"3","eleitores_aptos":239},
                    {"numero":"4","eleitores_aptos":238},
                    {"numero":"5","eleitores_aptos":238},
                    {"numero":"74","eleitores_aptos":236},
                    {"numero":"75","eleitores_aptos":237},
                    {"numero":"146","eleitores_aptos":236}
                ],
                "nome_local": "ESCOLA MUNICIPAL ELI BAHIENSE VAILANTE",
                "logradouro": "AVENIDA SÃO PAULO",
                "numero_logradouro": "142",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26553360",
                "uf": "RJ",
                "lat": -22.7779411,
                "lng": -43.4330008
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"132","eleitores_aptos":378},
                    {"numero":"175","eleitores_aptos":384},
                    {"numero":"178","eleitores_aptos":389},
                    {"numero":"181","eleitores_aptos":389},
                    {"numero":"182","eleitores_aptos":381},
                    {"numero":"183","eleitores_aptos":384},
                    {"numero":"186","eleitores_aptos":385},
                    {"numero":"187","eleitores_aptos":381},
                    {"numero":"188","eleitores_aptos":385},
                    {"numero":"189","eleitores_aptos":386}
                ],
                "nome_local": "ESCOLA MUNICIPAL MARIA DOLORES",
                "logradouro": "RUA MAGNO DE CARVALHO",
                "numero_logradouro": "2175",
                "municipio": "MESQUITA",
                "bairro": "CHATUBA",
                "cep": "26587320",
                "uf": "RJ",
                "lat": -22.8068085,
                "lng": -43.4420057
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"104","eleitores_aptos":288},
                    {"numero":"105","eleitores_aptos":287},
                    {"numero":"142","eleitores_aptos":286},
                    {"numero":"143","eleitores_aptos":287},
                    {"numero":"144","eleitores_aptos":286}
                ],
                "nome_local": "PRIMEIRA IGREJA BATISTA DE MESQUITA",
                "logradouro": "RUA PARANA",
                "numero_logradouro": "224",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26553020",
                "uf": "RJ",
                "lat": -22.7801235,
                "lng": -43.431495
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"69","eleitores_aptos":394},
                    {"numero":"70","eleitores_aptos":394},
                    {"numero":"71","eleitores_aptos":394},
                    {"numero":"72","eleitores_aptos":395},
                    {"numero":"73","eleitores_aptos":392},
                    {"numero":"147","eleitores_aptos":391},
                    {"numero":"153","eleitores_aptos":391},
                    {"numero":"154","eleitores_aptos":392},
                    {"numero":"155","eleitores_aptos":395},
                    {"numero":"169","eleitores_aptos":398},
                    {"numero":"199","eleitores_aptos":392}
                ],
                "nome_local": "COLEGIO ESTADUAL ANA NERI",
                "logradouro": "RUA AUGUSTO CARDOSO",
                "numero_logradouro": "180",
                "municipio": "MESQUITA",
                "bairro": "COREIA",
                "cep": "26556520",
                "uf": "RJ",
                "lat": -22.7804466,
                "lng": -43.4355039
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"106","eleitores_aptos":242},
                    {"numero":"107","eleitores_aptos":246},
                    {"numero":"108","eleitores_aptos":239},
                    {"numero":"109","eleitores_aptos":244},
                    {"numero":"110","eleitores_aptos":241},
                    {"numero":"111","eleitores_aptos":242},
                    {"numero":"170","eleitores_aptos":257}
                ],
                "nome_local": "IGREJA NOSSA SENHORA DAS GRACAS",
                "logradouro": "RUA PARANA",
                "numero_logradouro": "174",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26553020",
                "uf": "RJ",
                "lat": -22.7805454,
                "lng": -43.4312597
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"44","eleitores_aptos":371},
                    {"numero":"45","eleitores_aptos":376},
                    {"numero":"46","eleitores_aptos":376},
                    {"numero":"47","eleitores_aptos":373},
                    {"numero":"166","eleitores_aptos":376},
                    {"numero":"180","eleitores_aptos":379}
                ],
                "nome_local": "PAROQUIA NOSSA SENHORA DE FATIMA",
                "logradouro": "AVENIDA CASTELO BRANCO",
                "numero_logradouro": "322",
                "municipio": "MESQUITA",
                "bairro": "EDSON PASSOS",
                "cep": "26584-170",
                "uf": "RJ",
                "lat": -22.7967471,
                "lng": -43.4263355
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"133","eleitores_aptos":316},
                    {"numero":"134","eleitores_aptos":317},
                    {"numero":"135","eleitores_aptos":314},
                    {"numero":"136","eleitores_aptos":314},
                    {"numero":"137","eleitores_aptos":317},
                    {"numero":"156","eleitores_aptos":312},
                    {"numero":"157","eleitores_aptos":316},
                    {"numero":"158","eleitores_aptos":315},
                    {"numero":"172","eleitores_aptos":310},
                    {"numero":"174","eleitores_aptos":315},
                    {"numero":"184","eleitores_aptos":315}
                ],
                "nome_local": "TENIS CLUBE DE MESQUITA",
                "logradouro": "RUA ARTHUR DE OLIVEIRA VECHI",
                "numero_logradouro": "260",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26553080",
                "uf": "RJ",
                "lat": -22.7831957,
                "lng": -43.4314833
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"89","eleitores_aptos":216},
                    {"numero":"90","eleitores_aptos":182},
                    {"numero":"98","eleitores_aptos":225},
                    {"numero":"99","eleitores_aptos":230},
                    {"numero":"100","eleitores_aptos":211},
                    {"numero":"101","eleitores_aptos":219},
                    {"numero":"102","eleitores_aptos":229},
                    {"numero":"103","eleitores_aptos":222},
                    {"numero":"190","eleitores_aptos":170},
                    {"numero":"191","eleitores_aptos":165}
                ],
                "nome_local": "ESCOLA MUNICIPAL PROFESSOR MARCOS GIL",
                "logradouro": "ESTRADA FELICIANO SODRÉ",
                "numero_logradouro": "2315",
                "municipio": "MESQUITA",
                "bairro": "CENTRO",
                "cep": "26553440",
                "uf": "RJ",
                "lat": -22.7802776,
                "lng": -43.4301883
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"20","eleitores_aptos":373},
                    {"numero":"21","eleitores_aptos":377},
                    {"numero":"22","eleitores_aptos":391},
                    {"numero":"165","eleitores_aptos":398},
                    {"numero":"194","eleitores_aptos":396},
                    {"numero":"197","eleitores_aptos":384},
                    {"numero":"201","eleitores_aptos":388},
                    {"numero":"204","eleitores_aptos":372},
                    {"numero":"208","eleitores_aptos":382},
                    {"numero":"209","eleitores_aptos":382},
                    {"numero":"213","eleitores_aptos":386},
                    {"numero":"219","eleitores_aptos":305}
                ],
                "nome_local": "ESCOLA MUNICIPAL ERNESTO CHE GUEVARA",
                "logradouro": "RUA LIDIA",
                "numero_logradouro": "562",
                "municipio": "MESQUITA",
                "bairro": "CHATUBA",
                "cep": "26587000",
                "uf": "RJ",
                "lat": -22.8016232,
                "lng": -43.4353861
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"91","eleitores_aptos":292},
                    {"numero":"92","eleitores_aptos":237},
                    {"numero":"93","eleitores_aptos":284},
                    {"numero":"94","eleitores_aptos":296},
                    {"numero":"196","eleitores_aptos":241},
                    {"numero":"203","eleitores_aptos":236}
                ],
                "nome_local": "IGREJA METODISTA",
                "logradouro": "RUA PAULO MACEDO",
                "numero_logradouro": "212",
                "municipio": "MESQUITA",
                "bairro": "EDSON PASSOS",
                "cep": "26584180",
                "uf": "RJ",
                "lat": -22.797055,
                "lng": -43.4246996
            },
            {
                "zona": "150",
                "secoes": [
                    {"numero":"206","eleitores_aptos":382},
                    {"numero":"212","eleitores_aptos":388},
                    {"numero":"215","eleitores_aptos":349},
                    {"numero":"220","eleitores_aptos":133}
                ],
                "nome_local": "ESCOLA MUNICIPAL DE EDUCAÇÃO INFANTIL PEDRINHO",
                "logradouro": "AVENIDA MANUEL DUARTE",
                "numero_logradouro": "1215",
                "municipio": "MESQUITA",
                "bairro": "SANTA TEREZINHA",
                "cep": "26554161",
                "uf": "RJ",
                "lat": -22.79152300,
                "lng": -43.43783200
            }
        ]');

        // Criar locais e zonas eleitorais padrão:
        foreach($locais_eleitorais as $local) {
            $newLocal = \App\Models\LocalEleitoral::updateOrCreate([
                "nome_local" => mb_strtoupper($local->nome_local)
            ],
            [
                "nome_local" => $local->nome_local,
                "logradouro" => $local->logradouro,
                "numero_logradouro" => $local->numero_logradouro,
                "municipio" => $local->municipio,
                "bairro" => $local->bairro,
                "cep" => $local->cep,
                "uf" => $local->uf,
                "lat" => $local->lat,
                "lng" => $local->lng
            ]);

            foreach($local->secoes as $secao) {
                $z = str_pad("{$local->zona}", 4, "0", STR_PAD_LEFT);
                $s = str_pad("{$secao->numero}", 4, "0", STR_PAD_LEFT);

                \App\Models\SecaoEleitoral::updateOrCreate(
                    ["zona" => $z, "secao" => $s],
                    ["zona" => $z, "secao" => $s, "local_eleitoral_id" => $newLocal->id, "eleitores_aptos" => $secao->eleitores_aptos]
                );
            }
        }

        // Atribuir os Grupos para as Zonas e Seções criadas.
        // Atribuir 0000 caso um dos dois não for informado (zona/seção).
        // Ignorar caso nenhum informado (zona/seção).
        // p.s.: Criar nova zona+seção caso inexistente
        $grupos = \App\Models\Grupo::get();

        foreach ($grupos as $grupo) {
            if (!$grupo->zona AND !$grupo->secao) continue;

            $zona = $grupo->zona ? str_pad($grupo->zona, 4, "0", STR_PAD_LEFT) : "0000";
            $secao = $grupo->secao ? str_pad($grupo->secao, 4, "0", STR_PAD_LEFT) : "0000";
    
            $existingSecao = \App\Models\SecaoEleitoral::where(["zona" => $zona, "secao" => $secao])->first();
    
            if ($existingSecao === null) {
                $newSecao = new \App\Models\SecaoEleitoral;
                $newSecao->zona = $zona;
                $newSecao->secao = $secao;
                $newSecao->save();
            }

            $grupo->zona = $zona;
            $grupo->secao = $secao;
            $grupo->save();
        }
    }
}
