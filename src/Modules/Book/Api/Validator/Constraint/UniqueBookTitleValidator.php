<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Validator\Constraint;

use App\Modules\Book\Application\Exception\NotFoundBookException;
use App\Modules\Book\Application\Provider\BookProvider;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Contracts\Translation\TranslatorInterface;

class UniqueBookTitleValidator extends ConstraintValidator
{
    public function __construct(
        private readonly BookProvider $bookProvider,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueBookTitle) {
            throw new UnexpectedTypeException($constraint, UniqueBookTitle::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        try {
            $this->bookProvider->findByTitle($value);

            $this->context
                ->buildViolation($this->translator->trans($constraint->message, ['{{ title }}' => $value], 'exceptions'))
                ->addViolation()
            ;
        } catch (NotFoundBookException) {
        }
    }
}
