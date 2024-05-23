<?php
//da rivedere le date, definire meglio
function estraigiorni($giornoInLettere)
{
    if ($giornoInLettere == "Giornaliero") {
        //Manutenzione Giornaliera
        $today = strtotime('today');
        $tomorrow = $today + 86400;
        $formatted = date('d/m/Y', $tomorrow);
        return $formatted;
        //Fine Manutenzione Giornaliera
    } elseif ($giornoInLettere == "Settimanale") {
        //Manutenzione Settimanale
        $today = strtotime('today');
        $sevenDays = $today + (7 * 86400);
        $formatted = date('d/m/Y', $sevenDays);
        return $formatted;
        //Fine Manutenzione Settimanale
    } elseif ($giornoInLettere == "Quindicinale") {
        //Manutenzione Quindicinale
        $today = strtotime('today');
        $fitheendays = $today + (15 * 86400);
        $formatted = date('d/m/Y', $fitheendays);
        return $formatted;
        //Fine Manutenzione Quindicinale
    } elseif ($giornoInLettere == "4settimane") {
        //Manutenzione 4 Settimane, 28 giorni
        $today = strtotime('today');
        $fourweeks = $today + (28 * 86400);
        $formatted = date('d/m/Y', $fourweeks);
        return $formatted;
        //Fine Manutenzione 4 Settimane, 28 giorni
    } elseif ($giornoInLettere == "Mensile") {
        //Manutenzione 1mese
        $today = strtotime('today');
        $nextMonthTimestamp = strtotime('+1 month', $today);
        $formatted = date('d/m/Y', $nextMonthTimestamp);
        return $formatted;
        //Fine Manutenzione 1mese
    } elseif ($giornoInLettere == "Bimestrale") {
        //Manutenzione 2mese
        $today = strtotime('today');
        $next2MonthTimestamp = strtotime('+2 month', $today);
        $formatted = date('d/m/Y', $next2MonthTimestamp);
        return $formatted;
        //Fine Manutenzione 2mese
    } elseif ($giornoInLettere == "Trimestrale") {
        //Manutenzione 3mese
        $today = strtotime('today');
        $next = strtotime('+3 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 3mese
    } elseif ($giornoInLettere == "Semestrale") {
        //Manutenzione 6mese
        $today = strtotime('today');
        $next = strtotime('+6 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 6mese
    } elseif ($giornoInLettere == "9mesi") {
        //Manutenzione 9mese
        $today = strtotime('today');
        $next = strtotime('+9 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 9mese
    } elseif ($giornoInLettere == "4mesi") {
        //Manutenzione 4mese
        $today = strtotime('today');
        $next = strtotime('+4 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 4mese
    } elseif ($giornoInLettere == "Annuale") {
        //Manutenzione 1anno
        $today = strtotime('today');
        $next = $today + (365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 1anno
    } elseif ($giornoInLettere == "Quinquennale") {
        //Manutenzione 5anni
        $today = strtotime('today');
        $next = $today + (5 * 365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 5anni
    } elseif ($giornoInLettere == "Settennale") {
        //Manutenzione 7anni
        $today = strtotime('today');
        $next = $today + (7 * 365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 7anni
    } elseif ($giornoInLettere == "Decennale") {
        //Manutenzione 10anni
        $today = strtotime('today');
        $next = $today + (10 * 365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 10anni
    } else {
        echo "errore";
    }
}






//da rivedere le date, definire meglio
function prossimaManutenzione($datoDaAggiornare,$giorniInStringa){
    if ($giorniInStringa == "Giornaliero") {
        //Manutenzione Giornaliera
        $today = strtotime($datoDaAggiornare);
        $tomorrow = $today + 86400;
        $formatted = date('d/m/Y', $tomorrow);
        return $formatted;
        //Fine Manutenzione Giornaliera
    } elseif ($giorniInStringa == "Settimanale") {
        //Manutenzione Settimanale
        $today = strtotime($datoDaAggiornare);
        $sevenDays = $today + (7 * 86400);
        $formatted = date('d/m/Y', $sevenDays);
        return $formatted;
        //Fine Manutenzione Settimanale
    } elseif ($giorniInStringa == "Quindicinale") {
        //Manutenzione Quindicinale
        $today = strtotime($datoDaAggiornare);
        $fitheendays = $today + (15 * 86400);
        $formatted = date('d/m/Y', $fitheendays);
        return $formatted;
        //Fine Manutenzione Quindicinale
    } elseif ($giorniInStringa == "4settimane") {
        //Manutenzione 4 Settimane, 28 giorni
        $today = strtotime($datoDaAggiornare);
        $fourweeks = $today + (28 * 86400);
        $formatted = date('d/m/Y', $fourweeks);
        return $formatted;
        //Fine Manutenzione 4 Settimane, 28 giorni
    } elseif ($giorniInStringa == "Mensile") {
        //Manutenzione 1mese
        $today = strtotime($datoDaAggiornare);
        $nextMonthTimestamp = strtotime('+1 month', $today);
        $formatted = date('d/m/Y', $nextMonthTimestamp);
        return $formatted;
        //Fine Manutenzione 1mese
    } elseif ($giorniInStringa == "Bimestrale") {
        //Manutenzione 2mese
        $today = strtotime($datoDaAggiornare);
        $next2MonthTimestamp = strtotime('+2 month', $today);
        $formatted = date('d/m/Y', $next2MonthTimestamp);
        return $formatted;
        //Fine Manutenzione 2mese
    } elseif ($giorniInStringa == "Trimestrale") {
        //Manutenzione 3mese
        $today = strtotime($datoDaAggiornare);
        $next = strtotime('+3 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 3mese
    } elseif ($giorniInStringa == "Semestrale") {
        //Manutenzione 6mese
        $today = strtotime($datoDaAggiornare);
        $next = strtotime('+6 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 6mese
    } elseif ($giorniInStringa == "9mesi") {
        //Manutenzione 9mese
        $today = strtotime($datoDaAggiornare);
        $next = strtotime('+9 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 9mese
    } elseif ($giorniInStringa == "4mesi") {
        //Manutenzione 4mese
        $today = strtotime($datoDaAggiornare);
        $next = strtotime('+4 month', $today);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 4mese
    } elseif ($giorniInStringa == "Annuale") {
        //Manutenzione 1anno
        $today = strtotime($datoDaAggiornare);
        $next = $today + (365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 1anno
    } elseif ($giorniInStringa == "Quinquennale") {
        //Manutenzione 5anni
        $today = strtotime($datoDaAggiornare);
        $next = $today + (5 * 365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 5anni
    } elseif ($giorniInStringa == "Settennale") {
        //Manutenzione 7anni
        $today = strtotime($datoDaAggiornare);
        $next = $today + (7 * 365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 7anni
    } elseif ($giorniInStringa == "Decennale") {
        //Manutenzione 10anni
        $today = strtotime($datoDaAggiornare);
        $next = $today + (10 * 365 * 24 * 60 * 60);
        $formatted = date('d/m/Y', $next);
        return $formatted;
        //Fine Manutenzione 10anni
    } else {
        echo "errore";
    }
}
?>