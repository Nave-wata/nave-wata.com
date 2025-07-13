<?php

namespace App\Interfaces\Enum;

enum PageEnum: string
{
    case HOME = 'home';
    case ABOUT = 'about';
    case CONTACT = 'contact';
    case PRIVACY_POLICY = 'privacy-policy';
}
