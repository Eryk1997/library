<?php

declare(strict_types=1);

namespace App\Modules\Loan\Api\Validator\Constraint;

use App\Modules\Book\Application\Exception\NotFoundBookException;
use App\Modules\Book\Application\Provider\BookProvider;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Contracts\Translation\TranslatorInterface;

class ExistBookValidator extends ConstraintValidator
{
    public function __construct(
        private readonly BookProvider $bookProvider,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ExistBook) {
            throw new UnexpectedTypeException($constraint, ExistBook::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        try {
            $this->bookProvider->loadById($value);
        } catch (NotFoundBookException $exception) {
            $this->context
                ->buildViolation($this->translator->trans($exception->getMessage(), domain: 'exceptions'))
                ->addViolation()
            ;
        }
    }
}
