<?php

namespace Jimanx2\LumenSwaggerGenerator\Parser;

use Jimanx2\LumenSwaggerGenerator\VariableDescriberService;

/**
 * Trait WithVariableDescriber.
 */
trait WithVariableDescriber
{
    protected VariableDescriberService $describer;

    /**
     * Get describer instance
     *
     * @return VariableDescriberService
     */
    protected function describer(): VariableDescriberService
    {
        if (! isset($this->describer)) {
            $this->describer = app('swagger.describer');
        }

        return $this->describer;
    }
}
