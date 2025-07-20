<?php

declare(strict_types=1);

namespace App\Modules\Loan\Api\Validator\Constraint;

use App\Modules\Book\Application\Exception\NotFoundBookException;
use App\Modules\Book\Application\Provider\BookProvider;
use App\Modules\Loan\Application\Provider\LoanProvider;
use App\Modules\Loan\Domain\Enums\Status;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Contracts\Translation\TranslatorInterface;

class BookAvailableValidator extends ConstraintValidator
{
    public function __construct(
        private readonly BookProvider $bookProvider,
        private readonly LoanProvider $loanProvider,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof BookAvailable) {
            throw new UnexpectedTypeException($constraint, BookAvailable::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        try {
            $book = $this->bookProvider->loadById($value);

            $loanCounts = $this->loanProvider->countByBookIdAndStatus($book->getId()->toRfc4122(), Status::BORROWED);

            if ($book->getNumberCopies() <= $loanCounts) {
                $this->context
                    ->buildViolation($this->translator->trans(BookAvailable::$message, domain: 'exceptions'))
                    ->addViolation()
                ;
            }
        } catch (NotFoundBookException) {
        }
    }
}
