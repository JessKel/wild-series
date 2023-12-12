<?php

namespace App\Service;

use App\Entity\Program;
use App\Entity\Episode;

class ProgramDuration
{
    public function calculate(Program $program)
    {
        $duration = 0;
        $hours = 0;
        $days = 0;
        $total = '';

        $seasons = $program->getSeasons();
        if (!(is_null($seasons))){
            foreach ($seasons as $season) {
                $episodes = $season->getEpisodes();
                if(!(is_null($episodes))) {
                    foreach ($episodes as $episode) {
                        $duration += $episode->getDuration();
                    }
                }
            }
        }

        $hours = floor($duration/60);
        $duration = $duration - (60 * $hours);

        $days = floor($hours/24);
        $hours = $hours - (24 * $days);
        
        if ($days != 0)  {
            $total = $days . ' jour(s) ';
        }

        if ($hours !=0) {
            $total .= $hours .' heure(s) ';
        }

        if ($duration !=0) {
            $total .= $duration .' minute(s) ';
        }

        if ($total == '') {
            $total = 'Durée non disponible';
        }

        return $total;

    }

}
