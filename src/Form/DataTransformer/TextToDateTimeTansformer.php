<?php

namespace App\Form\DataTransformer;

use DateTime;
use Symfony\Component\Form\DataTransformerInterface;

class TextToDateTimeTansformer implements DataTransformerInterface
{
    /**
     * Transforms a DateTime to a String.
     *
     * @param  \DateTime $date
     */

    public function reverseTransform($dateStr): ?\DateTime
    {
        if (null === $dateStr) {
            return null;
        }

        return new DateTime($dateStr);

    }

    /**
     * Transforms a string to a datetime.
     *
     * @param  string|null $date
     */
    public function transform($date): ?string
    {
        return $date;
    }
}