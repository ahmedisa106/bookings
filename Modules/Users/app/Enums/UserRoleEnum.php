<?php

namespace Modules\Users\Enums;

enum UserRoleEnum: int
{
    case ADMIN = 1;
    case PROVIDER = 2;
    case CUSTOMER = 3;
}
