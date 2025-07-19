<?php

declare(strict_types=1);

namespace App\Modules\User\Api\Model\Login;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class LoginRequestModel
{
    public function __construct(
        #[NotBlank]
        #[Email]
        public string $email,
        #[NotBlank]
        public string $password,
    ) {
    }
}
