<?php

/**
 * Author -> Arafath Baig
 * PHP Version -> 8.0.9
 * Class for Breadth first traversal of Graphs
 */
class Dijkstra
{
    protected $graph;

    public function __construct($graph)
    {
        $this->graph = $graph;
    }

    /**
     * Function to get the shortest path
     * Passing the source and target as parameters
     * Using Dijkstra's solution
     */
    public function shortestPath($source, $target)
    {
        // array of best estimates of shortest path to each vertex
        $d = array();
        // array of predecessors for each vertex
        $pi = array();
        // queue of all unoptimized vertices
        $Q = new SplPriorityQueue();

        foreach ($this->graph as $v => $adj) {
            $d[$v] = INF; // set initial distance to "infinity"
            $pi[$v] = null; // no known predecessors yet
            foreach ($adj as $w => $cost) {
                // use the edge cost as the priority
                $Q->insert($w, $cost);
            }
        }

        // initial distance at source is 0
        $d[$source] = 0;

        while (!$Q->isEmpty()) {
            // extract min cost
            $u = $Q->extract();
            if (!empty($this->graph[$u])) {
                // "relax" each adjacent vertex
                foreach ($this->graph[$u] as $v => $cost) {
                    // alternate route length to adjacent neighbor
                    $alt = $d[$u] + $cost;
                    // if alternate route is shorter
                    if ($alt < $d[$v]) {
                        $d[$v] = $alt; // update minimum length to vertex
                        $pi[$v] = $u;  // add neighbor to predecessors for vertex
                    }
                }
            }
        }

        // we can now find the shortest path using reverse iteration
        $S = new SplStack(); // shortest path with a stack
        $u = $target;
        $dist = 0;
        // traverse from target to source
        while (isset($pi[$u])) {
            $S->push($u);
            $dist += $this->graph[$u][$pi[$u]]; // add distance to predecessor
            $u = $pi[$u];
        }

        // stack will be empty if there is no route back
        if ($S->isEmpty()) {
            echo "\nNo route from $source to $target";
        } else {
            // add the source node and print the path in reverse (LIFO) order
            $S->push($source);
            echo "$dist:";
            $sep = '';
            foreach ($S as $v) {
                echo $sep, $v;
                $sep = '->';
            }
            echo "\n";
        }
    }
}
$graphArray = array(
    'A' => array('B' => 3, 'D' => 3, 'F' => 6),
    'B' => array('A' => 3, 'D' => 1, 'E' => 3),
    'C' => array('E' => 2, 'F' => 3),
    'D' => array('A' => 3, 'B' => 1, 'E' => 1, 'F' => 2),
    'E' => array('B' => 3, 'C' => 2, 'D' => 1, 'F' => 5),
    'F' => array('A' => 6, 'C' => 3, 'D' => 2, 'E' => 5),
);
$graph = new Dijkstra($graphArray);

$graph->shortestPath('D', 'C');  // 3:D->E->C
$graph->shortestPath('C', 'A');  // 6:C->E->D->A
$graph->shortestPath('B', 'F');  // 3:B->D->F
$graph->shortestPath('F', 'A');  // 5:F->D->A 
$graph->shortestPath('A', 'G');  // No route from A to G