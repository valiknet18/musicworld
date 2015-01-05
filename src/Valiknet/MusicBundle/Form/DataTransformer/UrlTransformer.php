<?php
namespace Valiknet\MusicBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UrlTransformer implements DataTransformerInterface
{
    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  $value
     * @return string
     */
    public function transform($value)
    {
        if (null === $value) {
            return "";
        }

        return str_replace("embed/", "watch?v=", $value);
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param string $value
     *
     * @return string
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return;
        }

        return str_replace("watch?v=", "embed/", $value);
    }
}
