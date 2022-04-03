<?php

/**
 * Author -> Arafath Baig
 * PHP Version -> 8.0.9
 * Class for Depth first traversal of Graphs
 */

// The storage structure of graph adjacency matrix
class Graph
{
    // Storage node information
    public $vertices;
    // Storage side information
    public $arcs;
    // Number of nodes in a graph
    public $vexnum;
    // Record whether the node has been traversed
    public $visited = [];

    // initialization
    public function __construct($vertices)
    {
        $this->vertices = $vertices;
        $this->vexnum = count($this->vertices);
        for ($i = 0; $i < $this->vexnum; $i++) {
            for ($j = 0; $j < $this->vexnum; $j++) {
                $this->arcs[$i][$j] = 0;
            }
        }
    }

    // Add an edge between two vertices(Undirected graph)
    public function addEdge($a, $b)
    {
        if ($a == $b) { // The head and tail of an edge cannot be the same node
            return;
        }
        $this->arcs[$a][$b] = 1;
        $this->arcs[$b][$a] = 1;
    }

    // From the i Nodes start depth first traversal
    public function traverse($i)
    {
        // Mark the i Nodes traversed
        $this->visited[$i] = 1;
        // Print the currently traversed node
        echo $this->vertices[$i] . " ";
        // In ergodic adjacency matrix i Direct connection of nodes
        for ($j = 0; $j < $this->vexnum; $j++) {
            // The target node is directly connected with the current node, and the node has not been accessed yet. Recursion
            if ($this->arcs[$i][$j] == 1 && $this->visited[$j] == 0) {
                $this->traverse($j);
            }
        }
    }

    // recursion
    public function dfs()
    {
        // Initialize node traversal flag
        for ($i = 0; $i < $this->vexnum; $i++) {
            $this->visited[$i] = 0;
        }
        // Start deep traversal from nodes not traversed
        for ($i = 0; $i < $this->vexnum; $i++) {
            if ($this->visited[$i] == 0) {
                // If it is a connected graph, it will only be executed once
                $this->traverse($i);
            }
        }
    }

    // non-recursive 
    public function deepFirstSearch()
    {
        // Initialize node traversal flag
        for ($i = 0; $i < $this->vexnum; $i++) {
            $this->visited[$i] = 0;
        }
        $stack = [];
        for ($i = 0; $i < $this->vexnum; $i++) {
            if (!$this->visited[$i]) {
                $stack[] = $i;
                while (!empty($stack)) {
                    // Out of the stack
                    $curr = array_pop($stack);
                    // If the node has not been traversed, traverse the node and stack the child nodes
                    if ($this->visited[$curr] == 0) {
                        echo $this->vertices[$curr] . " ";
                        $this->visited[$curr] = 1;
                        // Non traversal child nodes are pushed
                        for ($j = $this->vexnum - 1; $j >= 0; $j--) {
                            if ($this->arcs[$curr][$j] == 1 && $this->visited[$j] == 0) {
                                $stack[] = $j;
                            }
                        }
                    }
                }
            }
        }
    }
}
// test
$vertices = ['v1', 'v2', 'v3', 'v4', 'v5', 'v6', 'v7', 'v8'];
$graph = new Graph($vertices);
$graph->addEdge(0, 1); // v1 v2
$graph->addEdge(0, 2); // v1 v3
$graph->addEdge(1, 3); // v2 v4
$graph->addEdge(1, 4); // v2 v5
$graph->addEdge(2, 5); // v3 v6
$graph->addEdge(2, 6); // v3 v7
$graph->addEdge(4, 7); // v5 v8
$graph->addEdge(3, 7); // v4 v8
// recursion
$graph->dfs();
// non-recursive 
echo "\n";
$graph->deepFirstSearch();
