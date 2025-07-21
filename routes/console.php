<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schedule;

Schedule::command('larasense:bot')->withoutOverlapping()->everyTenMinutes();

Schedule::command('queue:prune-failed')->daily();
