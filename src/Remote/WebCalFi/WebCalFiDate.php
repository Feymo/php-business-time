<?php

namespace BusinessTime\Remote\WebCalFi;

use Carbon\Carbon;

/**
 * Value object for a date retrieved from WebCal.fi.
 *
 * E.g. from https://www.webcal.fi/cal.php?id=83&format=json
 */
class WebCalFiDate
{
    /**
     * WebCalFiDate constructor.
     *
     * @param Carbon $date
     * @param string $name
     * @param string $url
     * @param string $description
     */
    public function __construct(
        public Carbon $date,
        public string $name = '',
        public string $url = '',
        public string $description = ''
    ) {
        $this->date = new Carbon($date);
        $this->name = $name;
        $this->url = $url;
        $this->description = $description;
    }
}
