<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schedule;

Schedule::command('larasense:bot')->withoutOverlapping()->everyFiveMinutes();

Schedule::command('queue:prune-failed')->daily();
