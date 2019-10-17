<?php


namespace Islami\Shared\Infrastructure\Persistence\Repository\Specification;


interface AndSpecification extends Specification
{

    public function specify(
        Specification $left_specification,
        Specification $right_specification)
    : Specification;

}
