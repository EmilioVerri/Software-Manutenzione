<?php
function estraigiorni($giornoInLettere) {
    switch ($giornoInLettere) {
        case "Giornaliero":
            $giorni = 1;
            break;
        case "Settimanale":
            $giorni = 7;
            break;
        case "Quindicinale":
            $giorni = 15;
            break;
        case "4settimane":
            $giorni = 28;
            break;
        case "Mensile":
            $giorni = 1; //1 mese
            break;
        case "Bimestrale":
            $giorni = 2; //2 mesi
            break;
        case "Trimestrale":
            $giorni = 3; //3 mesi
            break;
        case "Semestrale":
            $giorni = 6; //6 mesi
            break;
        case "9mesi":
            $giorni = 9; //9 mesi
            break;
        case "4mesi":
            $giorni = 4; //4 mesi
            break;
        case "Annuale":
            $giorni = 12; //1 anno
            break;
        case "Quinquennale":
            $giorni = 60; //5 anni
            break;
        case "Settennale":
            $giorni = 84; //7 anni
            break;
        case "Decennale":
            $giorni = 120; //10 anni
            break;
        default:
            echo "Frequenza non valida: " . $giornoInLettere;
            return null;
    }

    $oggi = strtotime('today');
    $dataProssima = strtotime('+' . $giorni . ' days', $oggi);

    if (in_array($giornoInLettere, ["Mensile", "Bimestrale", "Trimestrale", "Semestrale", "9mesi", "4mesi", "Annuale", "Quinquennale", "Settennale", "Decennale"])) {
        $dataProssima = calcolaProssimaData($oggi, $giorni);
    } else {
        $dataProssima = strtotime('+' . $giorni . ' days', $oggi);
    }

    $dataFormattata = date('d/m/Y', $dataProssima);
    return $dataFormattata;
}

function calcolaProssimaData($dataIniziale, $mesi) {
    $annoIniziale = date('Y', $dataIniziale);
    $meseIniziale = date('m', $dataIniziale);
    $giornoIniziale = date('d', $dataIniziale);

    $nuovoMese = $meseIniziale + $mesi;
    $nuovoAnno = $annoIniziale + floor($nuovoMese / 12);
    $nuovoMese = $nuovoMese % 12;
    if ($nuovoMese == 0) {
        $nuovoMese = 12;
        $nuovoAnno--;
    }

    $giorniNelNuovoMese = cal_days_in_month(CAL_GREGORIAN, $nuovoMese, $nuovoAnno);

    if ($giornoIniziale > $giorniNelNuovoMese) {
        $giornoIniziale = $giorniNelNuovoMese;
    }

    return mktime(0, 0, 0, $nuovoMese, $giornoIniziale, $nuovoAnno);
}

function is_leap_year($year) {
    if ($year % 4 != 0) {
        return false;
    } elseif ($year % 100 == 0 && $year % 400 != 0) {
        return false;
    } else {
        return true;
    }
}








//da rivedere le date, definire meglio
function prossimaManutenzione($datoDaAggiornare, $giorniInStringa)
{
    if ($giorniInStringa == "Giornaliero") {
        //Manutenzione Giornaliera
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+1 day');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione Giornaliera
    } elseif ($giorniInStringa == "Settimanale") {
        //Manutenzione Settimanale
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+7 day');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione Settimanale
    } elseif ($giorniInStringa == "Quindicinale") {
        //Manutenzione Quindicinale
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+15 day');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione Quindicinale
    } elseif ($giorniInStringa == "4settimane") {
        //Manutenzione 28 Giorni
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+28 day');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 28 Giorni
    } elseif ($giorniInStringa == "Mensile") {
        //Manutenzione 1mese
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+1 month');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 1mese
    } elseif ($giorniInStringa == "Bimestrale") {
        //Manutenzione 2mese
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+2 month');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 2mese
    } elseif ($giorniInStringa == "Trimestrale") {
        //Manutenzione 3mese
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+3 month');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 3mese
    } elseif ($giorniInStringa == "Semestrale") {
        //Manutenzione 6mese
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+6 month');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 6mese
    } elseif ($giorniInStringa == "9mesi") {
        //Manutenzione 9mese
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+9 month');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 9mese
    } elseif ($giorniInStringa == "4mesi") {
        //Manutenzione 4mese
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+4 month');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 4mese
    } elseif ($giorniInStringa == "Annuale") {
        //Manutenzione Annuale
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+1 year');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione Annuale
    } elseif ($giorniInStringa == "Quinquennale") {
        //Manutenzione 5 Anni
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+5 year');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 5 Anni
    } elseif ($giorniInStringa == "Settennale") {
        //Manutenzione 7 Anni
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+7 year');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 7 Anni
    } elseif ($giorniInStringa == "Decennale") {
        //Manutenzione 10 Anni
        date_default_timezone_set('Europe/Rome');


        $initialDate = $datoDaAggiornare;
        $dateTime = DateTime::createFromFormat('d/m/Y', $initialDate);

        // Check if DateTime object creation was successful
        if ($dateTime) {
            // Add four months to the DateTime object
            $dateTime->modify('+10 year');

            // Format the resulting date in the desired format
            $formatted = $dateTime->format('d/m/Y');
        }

        return $formatted;
        //Fine Manutenzione 10 Anni
    } else {
        echo "errore";
    }
}
?>