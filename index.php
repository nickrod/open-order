<?php

//

include 'config.php';

//

$message = 'Mercado Latino ordering program';

//

try
{
  // begin pdo

  $site_pdo->beginTransaction();

  // cookie auth

  include 'cookie.php';

  // begin logic

  if ($authenticated)
  {
    $message = 'You are logged in';
  }

  // end logic

  $site_pdo->commit();

  // end pdo
}
catch (Exception $e)
{
  $site_pdo->rollback();
  throw $e;
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>

  <body onload="loadStore();">
    <?php include 'header.php'; ?>

    <main role="main" class="container mt-3 mb-3">
      <div class="row pl-3 pr-3">
        <h1>MLI Ordering program</h1>
      </div>

      <div class="row pl-3 pr-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Library</li>
        </ol>
      </div>

      <form class="row pl-3 pr-3">
        <fieldset>
          <legend>Store</legend>

          <div class="form-row">
            <div class="form-group col-sm-0">
              <button type="button" class="btn btn-secondary" onclick="showHide('store-search');">&#x1F50D;</button>
            </div>
            <div id="store-search" class="form-group col-sm-4">
              <input type="text" class="form-control" id="store-search" oninput="itemSearch(this.id, 'store-results', 'store-id', 'store-title', 1);" placeholder="Search">
              <div id="store-results" class="list-group row pl-3 pr-3 position-absolute" style="z-index: 9; display: none;"></div>
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="store-id" oninput="setStore(this.id, this.value); itemIndex(this.value, 'store-title', 1);" placeholder="Id">
            </div>
            <div class="form-group col-sm-7">
              <input type="text" class="form-control" id="store-title" readonly="" placeholder="Title">
            </div>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="pickup">
              <label class="form-check-label" for="pickup">Pickup</label>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <textarea class="form-control" id="notes" rows="2" placeholder="Notes"></textarea>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Items</legend>

          <div class="form-row">
            <div class="form-group col-sm-3">
              <input type="text" class="form-control" id="item-search-1" oninput="itemSearch(this.id, 'item-results-1', 'item-id-1', 'item-title-1', 0);" placeholder="&#x1F50D; Search">
              <div id="item-results-1" class="list-group row pl-3 pr-3 position-absolute" style="z-index: 9; display: none;"></div>
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="item-id-1" oninput="setStore(this.id, this.value); itemIndex(this.value, 'item-title-1', 0);" placeholder="Id">
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="item-case-quantity-1" oninput="setStore(this.id, this.value);" placeholder="Case">
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="item-unit-quantity-1" readonly="" placeholder="Unit">
            </div>
            <div class="form-group col-sm-4">
              <input type="text" class="form-control" id="item-title-1" readonly="" placeholder="Title">
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="item-price-1" readonly="" placeholder="Price">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-sm-3">
              <input type="text" class="form-control" id="item-search-2" oninput="itemSearch(this.id, 'item-results-2', 'item-id-2', 'item-title-2', 0);" placeholder="&#x1F50D; Item 2 Search">
              <div id="item-results-2" class="list-group row pl-3 pr-3 position-absolute" style="z-index: 9; display: none;"></div>
            </div>
            <div class="form-group col-sm-5">
              <input type="text" class="form-control" id="item-title-2" readonly="" placeholder="Item 2 Title">
            </div>
            <div class="form-group col-sm-2">
              <input type="text" class="form-control" id="item-id-2" oninput="setStore(this.id, this.value); itemIndex(this.value, 'item-title-2', 0);" placeholder="Item 2 Id">
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="item-quantity-2" oninput="setStore(this.id, this.value);" placeholder="Qty">
            </div>
          </div>
        </fieldset>

        <fieldset id="show-more-block" style="display: none;">
          <div class="form-row">
            <div class="form-group col-sm-3">
              <input type="text" class="form-control" id="item-search-3" oninput="itemSearch(this.id, 'item-results-3', 'item-id-3', 'item-title-3', 0);" placeholder="&#x1F50D; Item 3 Search">
              <div id="item-results-3" class="list-group row pl-3 pr-3 position-absolute" style="z-index: 9; display: none;"></div>
            </div>
            <div class="form-group col-sm-5">
              <input type="text" class="form-control" id="item-title-3" readonly="" placeholder="Item 3 Title">
            </div>
            <div class="form-group col-sm-2">
              <input type="text" class="form-control" id="item-id-3" oninput="setStore(this.id, this.value); itemIndex(this.value, 'item-title-3', 0);" placeholder="Item 3 Id">
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="item-quantity-3" oninput="setStore(this.id, this.value);" placeholder="Qty">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-sm-3">
              <input type="text" class="form-control" id="item-search-4" oninput="itemSearch(this.id, 'item-results-4', 'item-id-4', 'item-title-4', 0);" placeholder="&#x1F50D; Item 4 Search">
              <div id="item-results-4" class="list-group row pl-3 pr-3 position-absolute" style="z-index: 9; display: none;"></div>
            </div>
            <div class="form-group col-sm-5">
              <input type="text" class="form-control" id="item-title-4" readonly="" placeholder="Item 4 Title">
            </div>
            <div class="form-group col-sm-2">
              <input type="text" class="form-control" id="item-id-4" oninput="setStore(this.id, this.value); itemIndex(this.value, 'item-title-4', 0);" placeholder="Item 4 Id">
            </div>
            <div class="form-group col-sm-1">
              <input type="text" class="form-control" id="item-quantity-4" oninput="setStore(this.id, this.value);" placeholder="Qty">
            </div>
          </div>
        </fieldset>
      </form>

      <div class="row pl-3 pr-3">
        <button id="show-more-button" type="button" class="btn btn-link" onclick="showMore('show-more-block', this.id);">Show more</button>
      </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="item.js?<?=hash_file('md5', 'item.js');?>"></script>
  </body>
</html>
