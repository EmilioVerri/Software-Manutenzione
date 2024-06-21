<?php
//da rivedere le date, definire meglio
function estraigiorni($giornoInLettere) {
    switch ($giornoInLettere) {
        case "Giornaliero":
            // Manutenzione Giornaliera
            $giorni = 1;
            break;
        case "Settimanale":
            // Manutenzione Settimanale
            $giorni = 7;
            break;
        case "Quindicinale":
            // Manutenzione Quindicinale
            $giorni = 15;
            break;
        case "4settimane":
            // Manutenzione 4 Settimane, 28 giorni
            $giorni = 28;
            break;
        case "Mensile":
            // Manutenzione 1mese
            $giorni = 31; // Set default to 31 days
            break;
        case "Bimestrale":
            // Manutenzione 2mese
            $giorni = 60;
            break;
        case "Trimestrale":
            // Manutenzione 3mese
            $giorni = 90;
            break;
        case "Semestrale":
            // Manutenzione 6mese
            $giorni = 180;
            break;
        case "9mesi":
            // Manutenzione 9mese
            $giorni = 270;
            break;
        case "4mesi":
            // Manutenzione 4mese
            $giorni = 120;
            break;
        case "Annuale":
            // Manutenzione 1anno
            $giorni = 365;
            break;
        case "Quinquennale":
            // Manutenzione 5anni
            $giorni = 1825;
            break;
        case "Settennale":
            // Manutenzione 7anni
            $giorni = 2555;
            break;
        case "Decennale":
            // Manutenzione 10anni
            $giorni = 3650;
            break;
        default:
            echo "Frequenza non valida: " . $giornoInLettere;
            return null;
    }

    $oggi = strtotime('today');
    $dataProssima = $oggi + $giorni * 24 * 60 * 60;

    // Adjust days for months with 30 or 31 days
    $meseProssimo = date('m', $dataProssima);
    $giorniMeseProssimo = 31; // Default to 31 days

    if ($meseProssimo === 2) {
        $isLeapYearNextYear = is_leap_year(date('Y', $dataProssima));
        $isLeapYearCurrentYear = is_leap_year(date('Y', $oggi));

        if ($isLeapYearNextYear && !$isLeapYearCurrentYear) {
            $giorniMeseProssimo = 29; // Set days to 29 for leap year February
        } else {
            $giorniMeseProssimo = 28; // Set days to 28 for non-leap year February
        }
    } else if (in_array($meseProssimo, [4, 6, 9, 11])) {
        $giorniMeseProssimo = 30; // Set days to 30 for April, June, September, November
    }

    // Check if the next day is beyond the end of the next month
    $giornoProssimo = date('d', $dataProssima);
    if ($giornoProssimo > $giorniMeseProssimo) {
        // If so, add days to reach the next month's first day
        $dataProssima += ($giorniMeseProssimo - $giornoProssimo + 1) * 24 * 60 * 60;
    }

    $dataFormattata = date('d/m/Y', $dataProssima);
    return $dataFormattata;
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