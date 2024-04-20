<?php

namespace App\Helpers;

class PlanData
{
    public static function getQuarterData($quarter, $year): array
    {
        $quarterData = [];
        if ($quarter == 1) {
            $quarterData = [
                'from' => $year . '-01-01',
                'to' => $year . '-03-31',
                'month1Start' => $year . '-01-01',
                'month1End' => $year . '-01-31',
                'month2Start' => $year . '-02-01',
                'month2End' => $year . '-02-31',
                'month3Start' => $year . '-03-01',
                'month3End' => $year . '-03-31',
                'monthNames' => [
                    'monthName1' => 'Styczeń',
                    'monthName2' => 'Luty',
                    'monthName3' => 'Marzec',
                ],
                'monthNumbers' => [1, 2, 3],
            ];
        } elseif ($quarter == 2) {
            $quarterData = [
                'from' => $year . '-04-01',
                'to' => $year . '-06-31',
                'month1Start' => $year . '-04-01',
                'month1End' => $year . '-04-31',
                'month2Start' => $year . '-05-01',
                'month2End' => $year . '-05-31',
                'month3Start' => $year . '-06-01',
                'month3End' => $year . '-06-31',
                'monthNames' => [
                    'monthName1' => 'Kwiecień',
                    'monthName2' => 'Maj',
                    'monthName3' => 'Czerwiec',
                ],
                'monthNumbers' => [4, 5, 6],
            ];
        } elseif ($quarter == 3) {
            $quarterData = [
                'from' => $year . '-07-01',
                'to' => $year . '-09-31',
                'month1Start' => $year . '-07-01',
                'month1End' => $year . '-07-31',
                'month2Start' => $year . '-08-01',
                'month2End' => $year . '-08-31',
                'month3Start' => $year . '-09-01',
                'month3End' => $year . '-09-31',
                'monthNames' => [
                    'monthName1' => 'Lipiec',
                    'monthName2' => 'Sierpień',
                    'monthName3' => 'Wrzesień',
                ],
                'monthNumbers' => [7, 8, 9],
            ];
        } elseif ($quarter == 4) {
            $quarterData = [
                'from' => $year . '-10-01',
                'to' => $year . '-12-31',
                'month1Start' => $year . '-10-01',
                'month1End' => $year . '-10-31',
                'month2Start' => $year . '-11-01',
                'month2End' => $year . '-11-31',
                'month3Start' => $year . '-12-01',
                'month3End' => $year . '-12-31',
                'monthNames' => [
                    'monthName1' => 'Październik',
                    'monthName2' => 'Listopad',
                    'monthName3' => 'Grudzień',
                ],
                'monthNumbers' => [10, 11, 12],
            ];
        } else {
            dd('Błąd');
        }

        return $quarterData;
    }
}
