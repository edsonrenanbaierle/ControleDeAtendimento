<?php

namespace App\ENUM;

enum Status : string
{
    case SCHEDULED = "scheduled";
    case COMPLETED = "completed";
    case CANCELED = "canceled";
}
