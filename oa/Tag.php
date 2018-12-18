<?php
namespace OA;

/**
 * Used to mark controller method with given tag
 *
 * @Annotation
 * @Target({"METHOD"})
 * @Attributes({
 *   @Attribute("name", type = "string"),
 * })
 */
class Tag
{
    public $name;

    /**
     * Tag constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        if (isset($values['value'])) {
            $values = ['name' => $values['value']];
        }
        $this->name = $values['name'];
    }
}
