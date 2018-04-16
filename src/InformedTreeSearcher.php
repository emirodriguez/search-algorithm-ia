<?php
namespace Search;

use Ds\Queue;
use Ds\Stack;

class InformedTreeSearcher
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
        string $endNode,
        bool $byProfundity = false
    ): array {

    }

    /**
     * Search the node of the solution
     *
     * @param array $connections
     * @param string $startNode
     * @param string $endNode
     *
     * @return Node|null
     */
    public function searchNode(
        array $connections,
        string $startNode,
        string $endNode
    ): ?Node {
        $startNode = new Node($startNode);
        $startNode->setCost(0);
        $visited = [];

        $borders = new Queue();

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

        //setear costo 0 al nodo inicial

        //mientras haya nodos

            //ordenar

            //pop

            //si es la solucion, retornar

            //sino, obtener los hijos, recorrerlos
                //buscar costo del hijo
                //hijo.set_costo(nodo.get_coste() + costo)

                //agregar a la lista de hijos

                //si el nodo no esta en la lista de visitados
                    //si el nodo esta en la lista de froteras
                        //recorrer nodos frontera
                            //si el nodo es el hijo y el costo del nodo es mayor al hijo
                                //reemplazar el nodo por el hijo

                    //sino
                        //agregar a la lista de nodos fronteras
    }

    private function orderQueue(Queue $queue)
    {
        $items = $queue->toArray();

        $items = usort($items, function (Node $first, Node $second) {
            return $first->getCost() < $second->getCost();
        });

        return $items;
    }
}
