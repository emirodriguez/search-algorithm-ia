<?php
namespace Search;

class Node
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Node
     */
    private $parent;

    /**
     * @var array
     */
    private $children;

    public function __construct(string $name, array $children = [], Node $parent = null)
    {
        $this->name = $name;
        $this->children = $children;
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return Node|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Node $parent
     */
    public function setParent(Node $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param Node[] $children
     */
    public function setChildren(array $children)
    {
        $this->children = $children;

        foreach ($children as $child) {
            $child->setParent($this);
        }
    }

    /**
     * @param Node[] $nodes
     * @return bool
     */
    public function inNodes(array $nodes): bool
    {
        foreach ($nodes as $node) {
            if ($node->getName() === $this->getName()) {
                return true;
            }
        }

        return false;
    }
}
