<?php

namespace AEngine\Orchid\Filter;

use AEngine\Orchid\Annotated\AnnotatedReflectionClass;
use AEngine\Orchid\Model;

class FilterModel extends Model
{
    public function filter($namespace = 'Filter')
    {
        // get model data
        $data = $this->toArray();

        // create filter instance
        $filter = new Filter($data);

        // get magic class
        $arc = new AnnotatedReflectionClass($this);

        foreach ($arc->getProperties() as $property) {
            $annotations = $property->getAnnotation($namespace, false);

            if ($annotations) {
                switch (true) {
                    case $property->hasAnnotation($namespace . '\\Required'):
                        $filter->attr($property->getName());
                        break;

                    default:
                        $filter->option($property->getName());
                        break;
                }

                foreach ($annotations as $item) {
                    $filter->addRule($item, $item->get('message'));
                }
            }
        }

        // run filter work
        $result = $filter->run();

        // set changed data in model
        $this->replace($data);

        return $result;
    }
}
