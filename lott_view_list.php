<?php
require('dbconn.php');
$get_data = pg_query($db, "SELECT lottery_id, lottery_date, lottery_time, lottery_file FROM lottery_date_time WHERE lottery_status = '1'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-14 bg-gradient-to-r from-purple-500 to-pink-500">

<section class="py-1 bg-blueGray-50">
<div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-center text-2xl uppercase text-blueGray-700 mb-8">Lottery Details</h3>
        </div>
      </div>
    </div>

    <div class="block w-full overflow-x-auto">
      <table class="items-center bg-transparent w-full border-collapse ">
        <thead>
          <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          Sno
                        </th>
          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          Lottery Date
                        </th>
           <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
            Lottery Time
                        </th>
          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
            Lottery File
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          Action
                        </th>       
          </tr>
        </thead>

        <tbody>
            <?php  
            if (pg_num_rows($get_data) > 0) {
              $sno = 0;
              while (list($lott_id, $lott_date, $lott_time, $lott_file) = pg_fetch_array($get_data)) {
                $sno++;
          ?>
          <tr>
            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
             <?= $sno ?>
            </th>
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
              <?= $lott_date ?>
            </td>
            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <?= $lott_time ?>
            </td>
            <td class="border-t-0 px-6 align-middle border-l-0 text-blue-800 border-r-0 text-xs whitespace-nowrap p-4">
                <a href="download.php?lott_file=<?= $lott_file ?>"><?= $lott_file ?></a>
            </td>
            <td class="border-t-0 px-6 align-middle border-l-0 text-red-800 font-bold border-r-0 text-xs whitespace-nowrap p-4">
                <a href="lott_delete.php?lott_id=<?= $lott_id ?>" class="font-bold">Delete</a>
            </td>

          </tr>
          <?php
              }
            }else{
              echo '<tr><td colspan="5"  class="p-4 text-center">No Records Found</td></tr>';
            }
            ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
</section>
              </body>