<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\HttpQuery;

use TyCode\Shared\Domain\Criteria\Criteria;
use TyCode\Shared\Domain\Criteria\OrderBy;
use Exception;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\HttpFoundation\InputBag;
use TyCode\Shared\Domain\Criteria\FilterOperator;
use TyCode\Shared\Domain\Criteria\Filters;
use TyCode\Shared\Domain\Criteria\Order;
use TyCode\Shared\Domain\Criteria\OrderType;

final class QueryCriteriaConverter
{
    public function __construct(private readonly string $clazz){}

    public function convert(InputBag $query): ?Criteria {
        $keys = $query->keys();
        $order = in_array('order_by', $keys) && in_array('order', $keys)
            ? new Order(
                new OrderBy($query->get('order_by')),
                new OrderType($query->get('order')))
            : Order::none();

        $limit      = $query->get('limit');
        $offset     = $query->get('offset');

        return new Criteria(
            Filters::fromValues($this->filters($query->all())),
            $order,
            $offset,
            $limit
        );
    }

    private function filters(array $queryAll): array
    {
        $filters = [];
        foreach ($queryAll as $key => $value) {
            if('operator' === $key){
                $results = $this->operatorToCriteria($value);
                foreach ($results as $criteria) {
                    $filters[] = $criteria;
                }
            }else{
                $filters[] = $this->fieldToCriteria($key, $value);
            }
        }

        return $filters;
    }

    private function getAttributeNames(string $clazz): array
    {
        $reflectionClass = new ReflectionClass($clazz);

        $attributes = [];
        /** @var ReflectionProperty $value */
        foreach ($reflectionClass->getProperties() as $key => $value) {
            $attributes[] = $value->getName();
        }

        return $attributes;
    }

    private function operatorToCriteria(array $operator): array
    {
        $criteria = [];
        foreach ($operator as $key => $value) {
            if('in' === $key || 'not_in' === $key){
                $exprs[0] = $value;
            }else{
                $exprs = explode(',', $value);
            }

            foreach ($exprs as $expr) {
                $criteria[] = [
                    'field' => $this->fieldExpr($expr),
                    'value' => $this->valueExpr($expr),
                    'operator' => match ($key) {
                         'lt' => FilterOperator::LT,
                         'gt' => FilterOperator::GT,
                         'equal' => FilterOperator::EQUAL,
                         'not_equal' => FilterOperator::NOT_EQUAL,
                         'in' => FilterOperator::IN,
                         'not_in' => FilterOperator::NOT_IN,
                         default => throw new Exception(sprintf('Operator %s is not valid.', $key))
                    }
                ];
            }
        }

        return $criteria;
    }

    private function fieldToCriteria(string $field, string $value): array
    {
        $this->validateField($field);

        return [
            'field' => $field,
            'value' => $value,
            'operator' => FilterOperator::EQUAL
        ];
    }

    private function fieldExpr(string $value): string
    {
        $field = strstr($value, ':', true);
        $this->validateField($field);

        return $field;
    }

    private function valueExpr(string $value): string
    {
        return substr($value, strpos($value, ':') + 1, strlen($value));
    }

    private function validateField(string $field): void
    {
        $possibleCriteria = self::getAttributeNames($this->clazz);

        if(!in_array($field, $possibleCriteria)){
            throw new Exception(sprintf('Field %s is not valid.', $field));
        }
    }

}
