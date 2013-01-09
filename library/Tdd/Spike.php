<?php

namespace Tdd;

class Spike
{
    public function parseArray(array $array)
    {
        $compare = array();

        foreach ($array as $spike) {
            $compare = array_merge($compare, $spike);
        }

        $result = array_filter(array_count_values($compare), function ($var) {
            if ($var != 1) {
                return false;
            }

            return true;
        });

        $final = array();

        foreach ($array as $designation => $spike) {
            $search = array_search(max(array_keys($result)), $spike);
            if ($search !== false) {
                $final[$designation] = max(array_keys($result));
                break;
            }
        }

        return $final;
    }
}
