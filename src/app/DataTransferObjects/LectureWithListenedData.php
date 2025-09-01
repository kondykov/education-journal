<?php
declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Models\Lecture;
use App\Models\LectureListened;

class LectureWithListenedData
{
    public Lecture $lecture;
    public ?LectureListened $listened;

    public function __construct($lecture, $listened = null)
    {
        $this->lecture = $lecture;
        $this->listened = $listened;
    }

    public function toArray()
    {
        return [
            'lecture' => $this->lecture->id,
            'listened' => $this->listened,
        ];
    }

}
