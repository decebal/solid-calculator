<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 19.02.2015
 * Time: 03:20
 */

namespace App\Models;
use App\Contracts\GraphAbstract;

/**
 * Class Graph
 *
 * @package App\Models
 */
class Graph extends GraphAbstract
{

    public function shortestPath($source, $target)
    {
        // array of best estimates of shortest path to each
        // vertex
        $vertex = array();

        // array of predecessors for each vertex
        $predecessors = array();

        // queue of all unoptimized vertices
        $queue = new \SplPriorityQueue();

        foreach ($this->graph as $v => $adj) {
            $vertex[$v] = INF; // set initial distance to "infinity"
            $predecessors[$v] = null; // no known predecessors yet
            foreach ($adj as $w => $cost) {
                // use the edge cost as the priority
                $queue->insert($w, $cost);
            }
        }
        unset($adj);
        var_dump($queue);
        // initial distance at source is 0
        $vertex[$source] = 0;

        while (!$queue->isEmpty()) {
            // extract min cost
            $queueValue = $queue->extract();
            if (!empty($this->graph[$queueValue])) {
                // "relax" each adjacent vertex
                foreach ($this->graph[$queueValue] as $v => $cost) {
                    // alternate route length to adjacent neighbor
                    $alt = $vertex[$queueValue] + $cost;
                    // if alternate route is shorter
                    if ($alt < $vertex[$v]) {
                        $vertex[$v] = $alt; // update minimum length to vertex
                        $predecessors[$v] = $queueValue;  // add neighbor to predecessors
                        //  for vertex
                    }
                }
                unset($cost);
            }
        }

        var_dump($predecessors);
        // we can now find the shortest path using reverse
        // iteration
        $stack = new \SplStack(); // shortest path with a stack
        $queueValue = $target;
        $dist = 0;
        // traverse from target to source
        while (isset($predecessors[$queueValue]) && $predecessors[$queueValue]) {
            $stack->push($queueValue);
            $dist += $this->graph[$queueValue][$predecessors[$queueValue]]; // add distance to predecessor
            $queueValue = $predecessors[$queueValue];
        }
        var_dump($stack);

        // stack will be empty if there is no route back
        if ($stack->isEmpty()) {
            echo "No route from $source to $target";
        } else {
            // add the source node and print the path in reverse
            // (LIFO) order
            $stack->push($source);
            echo "$dist:";
            $sep = '';
            foreach ($stack as $v) {
                echo $sep, $v;
                $sep = '->';
            }
            echo "n";
        }
    }
}