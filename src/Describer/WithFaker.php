<?php

namespace Jimanx2\LumenSwaggerGenerator\Describer;

use Faker\Generator;

/**
 * Trait WithFaker
 */
trait WithFaker
{
    protected Generator $faker;

    /**
     * Get faker instance
     *
     * @return \Faker\Generator
     */
    protected function faker(): Generator
    {
        if (! isset($this->faker)) {
            $locale = "en_US";
            if (function_exists("config")) {
                $locale = config("swagger-generator.faker_locale", "en_US");
            }
            $this->faker = \Faker\Factory::create($locale);
        }

        return $this->faker;
    }
}
