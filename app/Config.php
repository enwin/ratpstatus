<?php

class Config
{
    public static function getModeLibelles() {
        return ["metros" => "Ⓜ️ <span>Métros</span>", "trains" => "🚆 <span>RER/Trains</span>", "tramways" => "🚈 <span>Tramways</span>"];
    }

    public static function getLignes() {
        $baseUrlLogo = "/images/lignes/";

        return [
            "metros" => [
                "Métro 1" => $baseUrlLogo."/1.svg",
                "Métro 2" => $baseUrlLogo."/2.svg",
                "Métro 3" => $baseUrlLogo."/3.svg",
                "Métro 3B" => $baseUrlLogo."/3b.svg",
                "Métro 4" => $baseUrlLogo."/4.svg",
                "Métro 5" => $baseUrlLogo."/5.svg",
                "Métro 6" => $baseUrlLogo."/6.svg",
                "Métro 7" => $baseUrlLogo."/7.svg",
                "Métro 7B" => $baseUrlLogo."/7b.svg",
                "Métro 8" => $baseUrlLogo."/8.svg",
                "Métro 9" => $baseUrlLogo."/9.svg",
                "Métro 10" => $baseUrlLogo."/10.svg",
                "Métro 11" => $baseUrlLogo."/11.svg",
                "Métro 12" => $baseUrlLogo."/12.svg",
                "Métro 13" => $baseUrlLogo."/13.svg",
                "Métro 14" => $baseUrlLogo."/14.svg",
            ],
            "trains" => [
                "Ligne A" => $baseUrlLogo."/a.svg",
                "Ligne B" => $baseUrlLogo."/b.svg",
                "Ligne C" => $baseUrlLogo."/c.svg",
                "Ligne D" => $baseUrlLogo."/d.svg",
                "Ligne E" => $baseUrlLogo."/e.svg",
                "Ligne H" => $baseUrlLogo."/h.svg",
                "Ligne J" => $baseUrlLogo."/j.svg",
                "Ligne K" => $baseUrlLogo."/k.svg",
                "Ligne L" => $baseUrlLogo."/l.svg",
                "Ligne N" => $baseUrlLogo."/n.svg",
                "Ligne P" => $baseUrlLogo."/p.svg",
                "Ligne R" => $baseUrlLogo."/r.svg",
                "Ligne U" => $baseUrlLogo."/u.svg",
            ],
            "tramways" => [
                "T1" => $baseUrlLogo."/t1.svg",
                "T2" => $baseUrlLogo."/t2.svg",
                "T3A" => $baseUrlLogo."/t3a.svg",
                "T3B" => $baseUrlLogo."/t3b.svg",
                "T4" => $baseUrlLogo."/t4.svg",
                "T5" => $baseUrlLogo."/t5.svg",
                "T6" => $baseUrlLogo."/t6.svg",
                "T7" => $baseUrlLogo."/t7.svg",
                "T8" => $baseUrlLogo."/t8.svg",
                "T9" => $baseUrlLogo."/t9.svg",
                "T10" => $baseUrlLogo."/t10.svg",
                "T11" => $baseUrlLogo."/t11.svg",
                "T12" => $baseUrlLogo."/t12.svg",
                "T13" => $baseUrlLogo."/t13.svg",
            ]
        ];
    }

    public static function getTypesPerturbation() {
        return [
        Disruption::TYPE_PERTURBATION_PARTIELLE => "Perturbation partielle",
        Disruption::TYPE_PERTURBATION =>"Perturbation",
        Disruption::TYPE_PERTURBATION_FORTE => "Forte perturbation",
        Disruption::TYPE_INTERRUPTION_PARTIELLE => "Interruption partielle",
        Disruption::TYPE_INTERRUPTION_TOTALE => "Interruption sur l'ensemble de la ligne",
        Disruption::TYPE_STATIONS_NON_DESSERVIES => "Station(s) non desservie(s)",
        Disruption::TYPE_TRAINS_SUPPRIMES => "Trains supprimés",
        Disruption::TYPE_CHANGEMENT_HORAIRES => "Changement d'horaires",
        Disruption::TYPE_CHANGEMENT_COMPOSITION => "Changement de composition",
        Disruption::TYPE_AUCUNE => "Aucune perturbation en cours",
        ];
    }
}
