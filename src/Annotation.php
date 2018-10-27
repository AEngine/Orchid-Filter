<?php

namespace AEngine\Orchid\Filter;

// plug
if (!class_exists('Annotation')) {

    switch (true) {
        // uses orchid framework annotation
        case class_exists('AEngine\Orchid\Annotation'): {
            class Annotation extends \AEngine\Orchid\Annotation {}

            break;
        }

        // uses standalone annotation
        case class_exists('AEngine\Annotation'): {
            class Annotation extends \AEngine\Annotation {}

            break;
        }

        // no use annotations
        default: {
            class Annotation {}

            break;
        }
    }

}
