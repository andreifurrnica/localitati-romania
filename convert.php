<?php
$startTime = microtime(true);


// http://www.coursesweb.net
function replaceSpecialChars(string $string): string
{
    $rem = [
        'ă',
        'Ă',
        'ş',
        'Ş',
        'ţ',
        'Ţ',
        'à',
        'á',
        'â',
        'ã',
        'ä',
        'å',
        'æ',
        'ç',
        'è',
        'é',
        'ê',
        'ë',
        'ð',
        'ì',
        'í',
        'î',
        'ï',
        'ñ',
        'ò',
        'ó',
        'ô',
        'õ',
        'ö',
        'ø',
        '§',
        'ù',
        'ú',
        'û',
        'ü',
        'ý',
        'ÿ',
        'À',
        'Á',
        'Â',
        'Ã',
        'Ä',
        'Å',
        'Æ',
        'Ç',
        'È',
        'É',
        'Ê',
        'Ë',
        '€',
        'Ð',
        'Ì',
        'Í',
        'Î',
        'Ï',
        'Ñ',
        'Ò',
        'Ó',
        'Ô',
        'Õ',
        'Ö',
        'Ø',
        '§',
        'Ù',
        'Ú',
        'Û',
        'Ü',
        'Ý',
        'Ÿ',
        '&agrave;',
        '&aacute;',
        '&acirc;',
        '&atilde;',
        '&auml;',
        '&aring;',
        '&aelig;',
        '&ccedil;',
        '&egrave;',
        '&eacute;',
        '&ecirc;',
        '&euml;',
        '&eth;',
        '&igrave;',
        '&iacute;',
        '&icirc;',
        '&iuml;',
        '&ntilde;',
        '&ograve;',
        '&oacute;',
        '&ocirc;',
        '&otilde;',
        '&ouml;',
        '&oslash;',
        '&sect;',
        '&ugrave;',
        '&uacute;',
        '&ucirc;',
        '&uuml;',
        '&yacute;',
        '&yuml;',
        '&Agrave;',
        '&Aacute;',
        '&Acirc;',
        '&Atilde;',
        '&Auml;',
        '&Aring;',
        '&AElig;',
        '&Ccedil;',
        '&Egrave;',
        '&Eacute;',
        '&Ecirc;',
        '&Euml;',
        '&euro;',
        '&ETH;',
        '&Igrave;',
        '&Iacute;',
        '&Icirc;',
        '&Iuml;',
        '&Ntilde;',
        '&Ograve;',
        '&Oacute;',
        '&Ocirc;',
        '&Otilde;',
        '&Ouml;',
        '&Oslash;',
        '&sect;',
        '&Ugrave;',
        '&Uacute;',
        '&Ucirc;',
        '&Uuml;',
        '&Yacute;',
        '&Yuml;',
        'Þ',
        'ª',
    ];

    $add = [
        'a',
        'A',
        's',
        'S',
        't',
        'T',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'ae',
        'c',
        'e',
        'e',
        'e',
        'e',
        'ed',
        'i',
        'i',
        'i',
        'i',
        'n',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        's',
        'u',
        'u',
        'u',
        'u',
        'y',
        'y',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'AE',
        'C',
        'E',
        'E',
        'E',
        'E',
        'EUR',
        'ED',
        'I',
        'I',
        'I',
        'I',
        'N',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'S',
        'U',
        'U',
        'U',
        'U',
        'Y',
        'Y',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'ae',
        'c',
        'e',
        'e',
        'e',
        'e',
        'ed',
        'i',
        'i',
        'i',
        'i',
        'n',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        's',
        'u',
        'u',
        'u',
        'u',
        'y',
        'y',
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'AE',
        'C',
        'E',
        'E',
        'E',
        'E',
        'EUR',
        'ED',
        'I',
        'I',
        'I',
        'I',
        'N',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'S',
        'U',
        'U',
        'U',
        'U',
        'Y',
        'Y',
        'T',
        'S',
    ];

    return str_replace($rem, $add, $string);
}

function saveChildren(array &$target, array &$all, int $key)
{
    foreach ($all as $id => $item) {
        if ($item['parent_id'] == $key) {
            saveChildren($item, $all, $id);

            $target['children'][] = $item;

            unset($all[$id]);
        }
    }
}

$source = __DIR__ . '/siruta.csv';
$row = 1;

$counties = [];
$all = [];

if (($handle = fopen($source, 'rb')) !== false) {
    while (($data = fgetcsv($handle, 0, ';')) !== false) {
        if ($row === 1) {

            $row++;
            continue;
        }

        $data = [
            'id'        => substr($data[0], 0, -3),
            'name'      => replaceSpecialChars(utf8_encode($data[1])),
            'county_id' => $data[3],
            'parent_id' => substr($data[4], 0, -3),
            'region_id' => $data[8],
            'area_id'   => $data[7],
            'rank'      => $data[13],
            'type'      => $data[5],
            'children'  => [],
        ];

        if ($data['parent_id'] == 1) {
            $counties[] = $data;
        } else {
            $all[$data['id']] = $data;
        }

        $row++;
    }

    fclose($handle);
}

foreach ($counties as $key => $county) {
    saveChildren($counties[$key], $all, $county['id']);
}

file_put_contents(__DIR__ . '/output.json', json_encode($counties));

echo PHP_EOL;

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_last_error_msg();
} else {
    echo 'Done';
}

$duration = microtime(true) - $startTime;
echo 'Execution time: ' . $duration . ' s', PHP_EOL;
