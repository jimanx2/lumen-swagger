<?php

namespace OA;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;
use Jimanx2\LumenSwaggerGenerator\Parser\CleanupsDescribedData;
use Jimanx2\LumenSwaggerGenerator\Parser\WithVariableDescriber;
use Doctrine\Common\Annotations\Annotation\Attribute;

/**
 * Used to describe request body FormRequest class
 *
 * @Annotation
 * @Target({"CLASS","METHOD"})
 * @Attributes({
 *   @Attribute("description", type="string", required=false),
 *   @Attribute("contentType", type="string", required=false),
 * })
 */
class RequestBodyJson extends RequestBody
{
    use CleanupsDescribedData, WithVariableDescriber;

    /**
     * Get object string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return (string)json_encode($this->content);
    }

    /**
     * Process content row by row recursively.
     *
     * @param  array $content
     * @return array
     */
    protected function processContent(array $content): array
    {
        $result = [];
        $required = [];
        foreach ($content as $key => $row) {
            if (is_object($row)) {
                if (! method_exists($row, 'toArray')) {
                    continue;
                }
                if ($row instanceof RequestParam) {
                    $row->toArrayRecursive($result);
                    if ($row->required && ! $row->isNested()) {
                        $required[] = $row->name;
                    }
                } else {
                    $result[$key] = $this->describer()->describe($row->toArray());
                }
            } elseif (is_array($row)) {
                $result[$key] = $this->processContent($row);
            } else {
                $result[$key] = $row;
            }
            if (isset($result[$key]) && is_array($result[$key])) {
                $currentRow = &$result[$key];
                static::handleIncompatibleTypeKeys($currentRow);
            }
        }
        if (! empty($result) && ! empty($requiredAttributes = array_unique(array_merge($this->required, $required)))) {
            $result['required'] = $requiredAttributes;
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        if (! is_array($this->content)) {
            throw new \RuntimeException("'OA\RequestBodyJson::\$content' must be array");
        }
        $content = $this->processContent($this->content);

        return [
            'description' => $this->description ?? '',
            // 'required' => true,
            'content' => [
                $this->contentType => [
                    'schema' => $content,
                ],
            ],
        ];
    }
}
