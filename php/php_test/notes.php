<?php
usort($array, function ($p1, $p2) {
    return $p2['sort'] <=> $p1['sort'];
});
