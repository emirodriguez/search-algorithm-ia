<?php

namespace Search;

use Ds\Queue;
use Ds\Stack;

class InformedSearcher
{
    /**
     * Search the path of the solution
     *
     * @param array $connections
     * @param array $heuristics
     * @param string $startNode
     * @param string $endNode
     * @param bool $byProfundity
     *
     * @return array
     */
    public function searchSolution(
        array $connections,
        array $heuristics,
        string $startNode,
        string $endNode
    ): array
    {
        $result = [];

        $solutionNode = $this->searchNode($connections, $heuristics, $startNode, $endNode);

        $node = $solutionNode;

        if (!empty($node)) {
            while (!empty($node->getParent())) {
                array_push($result, $node->getName());
                $node = $node->getParent();
            }

            array_push($result, $startNode);

            $result = array_reverse($result);
        }

        return [
            'result' => $result,
            'cost' => $solutionNode->getCost(),
        ];
    }

    /**
     * Search the node of the solution
     *
     * @param array $connections
     * @param array $heuristics
     * @param string $startNode
     * @param string $endNode
     *
     * @return Node|null
     */
    public function searchNode(
        array $connections,
        array $heuristics,
        string $startNode,
        string $endNode
    ): ?Node
    {
        $startNode = new Node($startNode);
        $startNode->setCost(0);
        $visited = [];

        $borders = new Queue();

        $borders->push($startNode);

        while ($borders->count() > 0) {
            $borders = $this->orderQueue($borders, $heuristics);

            /** @var Node $node */
            $node = $borders->pop();

            array_push($visited, $node);

            if ($node->getName() === $endNode) {
                return $node;
            }

            $children = [];
            foreach ($connections[$node->getName()] as $key => $value) {
                $child = new Node($key);

                $cost = $value;
                $child->setCost($node->getCost() + $cost);

                array_push($children, $child);

                if (!$child->inNodes($visited)) {
                    $borders->push($child);

                    if ($child->inNodes($borders->toArray())) {
                        /** @var Node $border */
                        foreach ($borders->toArray() as $border) {
                            if ($border->getName() === $child->getName() && $border->getCost() > $child->getCost()) {
                                $borders = $this->removeFromQueue($borders, $border);
                                $borders->push($child);
                            }
                        }
                    } else {
                        $borders->push($child);
                    }
                }
            }

            $node->setChildren($children);
        }

        return null;
    }

    private function orderQueue(Queue $queue, array $heuristics): Queue
    {
        $items = $queue->toArray();

        uasort($items, function (Node $first, Node $second) use ($heuristics) {
            $hx = $heuristics[$first->getName()];
            $gx = $first->getCost();
            $fx = $hx + $gx;

            $hy = $heuristics[$second->getName()];
            $gy = $second->getCost();
            $fy = $hy + $gy;

            return $fx > $fy;
        });

        return new Queue($items);
    }

    private function removeFromQueue(Queue $queue, Node $node): Queue
    {
        $items = $queue->toArray();

        $items = array_filter($items, function (Node $n) use ($node) {
            return ($n->getName() !== $node->getName());
        });

        return new Queue($items);
    }
}
