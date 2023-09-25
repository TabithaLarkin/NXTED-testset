<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

class Matrix
{
    private array $matrix;

    public function __construct(private int $size)
    {
        // Create matrix
        $this->matrix = array_fill(0, $size + 1, array_fill(0, $size + 1, 0));

        // Populate matrix
        for ($i = 0; $i < $size; $i++) {
            $this->matrix[0][$i] = 0.5;
            $this->matrix[$i + 1][$i] = 0.5;
        }

        $this->matrix[$size][$size] = 1;
    }

    public function power(int $power): array
    {
        $result = $this->matrix;
        for ($i = 1; $i < $power; $i++) {
            $result = $this->multiply($result);
        }

        return $result;
    }

    public function print(array $matrix): void
    {
        for ($i = 0; $i < $this->size + 1; $i++) {
            echo "[";
            for ($j = 0; $j < $this->size + 1; $j++) {
                echo "{$matrix[$i][$j]}, ";
            }
            echo "]\n";
        }
    }

    private function multiply(array $input): array
    {
        $res = [];
        for ($i = 0; $i < $this->size + 1; $i++) {
            $res[$i] = [];
            for ($j = 0; $j < $this->size + 1; $j++) {
                $res[$i][$j] = 0;
                for ($k = 0; $k < $this->size + 1; $k++)
                    $res[$i][$j] += $input[$i][$k] * $this->matrix[$k][$j];
            }
        }

        return $res;
    }
}
