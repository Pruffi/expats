<?php

// loads language array into  $__icl_lang_names
require_once ICL_PLUGIN_PATH . '/res/languages.csv.php';
$langs_names = unserialize($__icl_lang_names); 

/* - disabled this in favor of reading from a php file 
$fh = fopen(ICL_PLUGIN_PATH . '/res/languages.csv', 'r');
$idx = 0;
while($data = fgetcsv($fh)){
    if($idx == 0){
        foreach($data as $k=>$v){
            if($k < 3) continue;
            $lang_idxs[] = $v; 
        }
    }else{
        foreach($data as $k=>$v){
            if($k < 2) continue;                    
            if($k == 2){
                $langs_names[$lang_idxs[$idx-1]]['major'] = intval($v);
                continue;
            }
            $langs_names[$lang_idxs[$idx-1]]['tr'][$lang_idxs[$k-3]] = $v; 
        }
    }
    $idx++;
}
*/

$lang_codes = array(
    'Afar'    => 'aa',
    'Abkhazian'    => 'ab',
    'Avestan'    => 'ae',
    'Afrikaans'    => 'af',
    'Akan'    => 'ak',
    'Amharic'    => 'am',
    'Arabic'    => 'ar',
    'Assamese'    => 'as',
    'Avar'    => 'av',
    'Aymara'    => 'ay',
    'Azerbaijani'    => 'az',
    'Bashkir'    => 'ba',
    'Belarusian'    => 'be',
    'Bulgarian'    => 'bg',
    'Bihari'    => 'bh',
    'Bislama'    => 'bi',
    'Bambara'    => 'bm',
    'Bengali'    => 'bn',
    'Tibetan'    => 'bo',
    'Breton'    => 'br',
    'Bosnian'    => 'bs',
    'Catalan'    => 'ca',
    'Chechen'    => 'ce',
    'Chamorro'    => 'ch',
    'Corsican'    => 'co',
    'Cree'    => 'cr',
    'Czech'    => 'cs',
    'Old Slavonic'    => 'cu',
    'Chuvash'    => 'cv',
    'Welsh'    => 'cy',
    'Danish'    => 'da',
    'German'    => 'de',
    'Maldivian'    => 'dv',
    'Bhutani'    => 'dz',
    'Ewe'    => 'ee',
    'Greek'    => 'el',
    'English'    => 'en',
    'Esperanto'    => 'eo',
    'Spanish'    => 'es',
    'Estonian'    => 'et',
    'Basque'    => 'eu',
    'Persian'    => 'fa',
    'Fulah'    => 'ff',
    'Finnish'    => 'fi',
    'Fiji'    => 'fj',
    'Faeroese'    => 'fo',
    'French'    => 'fr',
    'Frisian'    => 'fy',
    'Irish'    => 'ga',
    'Scots Gaelic'    => 'gd',
    'Galician'    => 'gl',
    'Guarani'    => 'gn',
    'Gujarati'    => 'gu',
    'Manx'    => 'gv',
    'Hausa'    => 'ha',
    'Hebrew'    => 'he',
    'Hindi'    => 'hi',
    'Hiri Motu'    => 'ho',
    'Croatian'    => 'hr',
    'Hungarian'    => 'hu',
    'Armenian'    => 'hy',
    'Herero'    => 'hz',
    'Interlingua'    => 'ia',
    'Indonesian'    => 'id',
    'Interlingue'    => 'ie',
    'Igbo'    => 'ig',
    'Inupiak'    => 'ik',
    'Icelandic'    => 'is',
    'Italian'    => 'it',
    'Inuktitut'    => 'iu',
    'Japanese'    => 'ja',
    'Javanese'    => 'jv',
    'Georgian'    => 'ka',
    'Kongo'    => 'kg',
    'Kikuyu'    => 'ki',
    'Kwanyama'    => 'kj',
    'Kazakh'    => 'kk',
    'Greenlandic'    => 'kl',
    'Cambodian'    => 'km',
    'Kannada'    => 'kn',
    'Korean'    => 'ko',
    'Kanuri'    => 'kr',
    'Kashmiri'    => 'ks',
    'Kurdish'    => 'ku',
    'Komi'    => 'kv',
    'Cornish'    => 'kw',
    'Kirghiz'    => 'ky',
    'Latin'    => 'la',
    'Luxembourgish'    => 'lb',
    'Luganda'    => 'lg',
    'Lingala'    => 'ln',
    'Laothian'    => 'lo',
    'Lithuanian'    => 'lt',
    'Latvian'    => 'lv',
    'Malagasy'    => 'mg',
    'Marshallese'    => 'mh',
    'Maori'    => 'mi',
    'Macedonian'    => 'mk',
    'Malayalam'    => 'ml',
    'Mongolian'    => 'mn',
    'Moldavian'    => 'mo',
    'Marathi'    => 'mr',
    'Malay'    => 'ms',
    'Maltese'    => 'mt',
    'Burmese'    => 'my',
    'Nauru'    => 'na',
    'North Ndebele'    => 'nd',
    'Nepali'    => 'ne',
    'Ndonga'    => 'ng',
    'Dutch'    => 'nl',            
    'Norwegian Bokmål'    => 'nb',
    'Norwegian Nynorsk'    => 'nn',
    'South Ndebele'    => 'nr',
    'Navajo'    => 'nv',
    'Chichewa'    => 'ny',
    'Occitan'    => 'oc',
    'Oromo'    => 'om',
    'Oriya'    => 'or',
    'Ossetian'    => 'os',
    'Punjabi'    => 'pa',
    'Pali'    => 'pi',
    'Polish'    => 'pl',
    'Pashto'    => 'ps',
    'Portuguese, Portugal'    => 'pt-pt',
    'Portuguese, Brazil'    => 'pt-br',
    'Quechua'    => 'qu',
    'Rhaeto-Romance'    => 'rm',
    'Kirundi'    => 'rn',
    'Romanian'    => 'ro',
    'Russian'    => 'ru',
    'Kinyarwanda'    => 'rw',
    'Sanskrit'    => 'sa',
    'Sardinian'    => 'sc',
    'Sindhi'    => 'sd',
    'Northern Sami'    => 'se',
    'Sango'    => 'sg',
    'Serbo-Croatian'    => 'sh',
    'Singhalese'    => 'si',
    'Slovak'    => 'sk',
    'Slovenian'    => 'sl',
    'Samoan'    => 'sm',
    'Shona'    => 'sn',
    'Somali'    => 'so',
    'Albanian'    => 'sq',
    'Serbian'    => 'sr',
    'Siswati'    => 'ss',
    'Sesotho'    => 'st',
    'Sudanese'    => 'su',
    'Swedish'    => 'sv',
    'Swahili'    => 'sw',
    'Tamil'    => 'ta',
    'Telugu'    => 'te',
    'Tajik'    => 'tg',
    'Thai'    => 'th',
    'Tigrinya'    => 'ti',
    'Turkmen'    => 'tk',
    'Tagalog'    => 'tl',
    'Setswana'    => 'tn',
    'Tonga'    => 'to',
    'Turkish'    => 'tr',
    'Tsonga'    => 'ts',
    'Tatar'    => 'tt',
    'Twi'    => 'tw',
    'Tahitian'    => 'ty',
    'Uighur'    => 'ug',
    'Ukrainian'    => 'uk',
    'Urdu'    => 'ur',
    'Uzbek'    => 'uz',
    'Venda'    => 've',
    'Vietnamese'    => 'vi',
    'Wolof'    => 'wo',
    'Xhosa'    => 'xh',
    'Yiddish'    => 'yi',
    'Yoruba'    => 'yo',
    'Zhuang'    => 'za',
    'Chinese (Simplified)'    => 'zh-hans',
    'Chinese (Traditional)'    => 'zh-hant',
    'Zulu'    => 'zu',
    'Slavic'    => 'sla'
);  

$lang_locales = array(
    'en'    => 'en_US',
    'af'    => 'af',
    'ar'    => 'ar',
    'bn'    => 'bn_BD',
    'eu'    => 'eu',
    'be'    => 'be_BY',
    'bg'    => 'bg_BG',
    'ca'    => 'ca',
    'zh-hans'=> 'zh_CN',
    'zh-hant'=> 'zh_TW',
    'hr'    => 'hr',
    'cs'    => 'cs_CZ',
    'da'    => 'da_DK',
    'nl'    => 'nl_NL',
    'eo'    => 'eo',
    'et'    => 'et',
    'fo'    => 'fo',
    'fi'    => 'fi',
    'fr'    => 'fr_FR',
    'gl'    => 'gl_ES',
    'ka'    => 'ge_GE',
    'de'    => 'de_DE',
    'el'    => 'el',
    'he'    => 'he_IL',
    'hu'    => 'hu_HU',
    'is'    => 'is_IS',
    'id'    => 'id_ID',
    'it'    => 'it_IT',
    'ja'    => 'ja',
    'km'    => 'km_KH',
    'ko'    => 'ko_KR',
    'ku'    => 'ku',
    'lv'    => 'lv',
    'lt'    => 'lt',
    'mk'    => 'mk_MK',
    'mg'    => 'mg_MG',
    'ms'    => 'ms_MY',
    'ni'    => 'ni_ID',
    'nb'    => 'nb_NO',
    'fa'    => 'fa_IR',
    'pl'    => 'pl_PL',
    'pt-pt' => 'pt_PT',
    'pt-br' => 'pt_BR',
    'ro'    => 'ro_RO',
    'ru'    => 'ru_RU',
    'sr'    => 'sr_RS',
    'si'    => 'si_LK',          
    'sk'    => 'sk_SK',
    'sl'    => 'sl_SI',
    'es'    => 'es_ES',
    'su'    => 'su_ID',
    'sv'    => 'sv_SE',
    'tg'    => 'tg',
    'th'    => 'th',
    'tr'    => 'tr',
    'uk'    => 'uk_UA',
    'ug'    => 'ug',
    'uz'    => 'uz_UZ',
    'vi'    => 'vi',
    'cy'    => 'cy'
)
?>