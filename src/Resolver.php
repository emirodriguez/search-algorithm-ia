<?php
namespace Search;

use Ds\Queue;
use Ds\Stack;

class Resolver
{
    /**
     * Search the path of the solution
     *
     * @param array $connections
     * @param string $startNode
     * @param string $endNode
     * @param bool $byAmplitude
     * @return array
     */
    public function searchSolution(array $connections, string $startNode, string $endNode, bool $byAmplitude = false): array
    {
        $result = [];

        $solutionNode = $this->searchNode($connections, $startNode, $endNode, $byAmplitude);

        if (!empty($solutionNode)) {
            while (!empty($solutionNode->getParent())) {
                array_push($result, $solutionNode->getName());
                $solutionNode = $solutionNode->getParent();
            }

            array_push($result, $startNode);

            $result = array_reverse($result);
        }

        return $result;
    }

    /**
     * Search the node of the solution
     *
     * @param array $connections
     * @param string $startNode
     * @param string $endNode
     * @param bool $byAmplitude
     * @return Node|null
     */
    public function searchNode(array $connections, string $startNode, string $endNode, bool $byAmplitude)
    {
        $startNode = new Node($startNode);
        $visited = [];

        if ($byAmplitude) {
            $borders = new Stack();
        } else {
            $borders = new Queue();
        }

        $borders->push($startNode);

        while ($borders->count() > 0) {
            /** @var Node $node */
            $node = $borders->pop();
            array_push($visited, $node);

            if ($node->getName() === $endNode) {
                return $node;
            }

            $children = [];
            foreach ($connections[$node->getName()] as $connection) {
                $child = new Node($connection);
                array_push($children, $child);

                if (!$child->inNodes($visited) && !$child->inNodes($borders->toArray())) {
                    $borders->push($child);
                }
            }

            $node->setChildren($children);
        }

        return null;
    }
}
