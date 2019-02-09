<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Http\Resources\MissingValue;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->mergeWhen('2>1', 'test'),
            'post' => $this->whenLoaded('posts', 'photo'),
        ];
    }

    public static function test()
    {
        return 'ahmed';
    }

    protected function whenLoaded($relationship, $nestedRelationShip, $value = null, $default = null)
    {

        if (func_num_args() < 4) {
            $default = new MissingValue;
        }
        if (!$this->resource->relationLoaded($relationship)) {
            return value($default);
        }
        if (func_num_args() === 1) {
            return $this->resource->{$relationship};
        }
        if (func_num_args() === 2) {
            return $this->resource->{$relationship}->load($nestedRelationShip);
        }

        if ($this->resource->{$relationship} === null) {
            return null;
        }

        return value($value);
    }

    protected function mergeWhen($condition, $methodOrValue)
    {
        return $condition ? new MergeValue(value($methodOrValue)) : new MissingValue;
        $class = static::class;
        if (!$condition) {
            return new MissingValue;
        }
        if (!method_exists($class, $methodOrValue)) {
            // in this case this $methodOrValue called as $value
            return new MergeValue($methodOrValue);
        }
        // in this case this methodOrValue called as $method
        $resultOfMethod = forward_static_call([$class, $methodOrValue]);
        return new MergeValue($resultOfMethod);
    }
}
