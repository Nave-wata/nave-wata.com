<?php

namespace App\Interfaces\Enum;

enum OgpTypeEnum: string
{
    case WEBSITE = 'website';
    case ARTICLE = 'article';
    case PROFILE = 'profile';
    case BLOG = 'blog';
}
