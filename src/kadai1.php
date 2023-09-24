<?php

namespace Nxted;

use InvalidArgumentException;
use Nxted\Kadai1\Item;
use Nxted\Kadai1\ItemPricer;

require "vendor/autoload.php";

function tryInitialise()
{
  echo "番号を二つ入力してください。\n";

  $input = explode(' ', trim(fgets(STDIN)));

  if (count($input) !== 2) {
    echo "入力は二つではありません。";
    return null;
  }

  try {
    InputHelper::checkNumericInput($input);

    if ($input[1] < 1)
      throw new InvalidArgumentException("二番目のパラメータは１より大きくなければなりません。");

    $maxRules = min($input[0] * ($input[0] - 1), 10000);

    if ($input[1] > $maxRules)
      throw new InvalidArgumentException("{$input[1]}は{$maxRules}を超えてはなりません。");

    return array('pricer' => new ItemPricer($input[0]), 'relations' => $input[1]);
  } catch (InvalidArgumentException $e) {
    echo $e->getMessage();
  }

  return null;
}

function tryAddRelation(ItemPricer $pricer): bool
{
  $input = explode(' ', trim(fgets(STDIN)));

  if (count($input) !== 3) {
    echo "入力は三つではありません。";
    return false;
  }

  try {
    InputHelper::checkNumericInput($input);
  } catch (InvalidArgumentException $e) {
    echo $e->getMessage();
    return false;
  }

  try {
    $pricer->addRelation(...$input);
  } catch (InvalidArgumentException $e) {
    echo $e->getMessage();
    return false;
  }

  return true;
}

function calculatePrices(): void
{
  $init = null;

  while ($init === null)
    $init = tryInitialise();

  $pricer = $init['pricer'];

  $relations = $init['relations'];

  for ($i = 0; $i < $relations; $i++) {
    $added = false;
    while (!$added) {
      $idx = $i + 1;
      echo "次のルールを入力してください。[{$idx}/{$relations}]\n";
      $added = tryAddRelation($pricer);
    }
  }

  $success = $pricer->evaluatePrices();

  if (!$success)
    echo "-1\n";
  else
    $pricer->forEachItem(function (Item $item) {
      echo "{$item->getPrice()}\n";
    });
}

calculatePrices();

exit();
