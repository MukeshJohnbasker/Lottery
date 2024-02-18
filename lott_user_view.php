<?php
require('dbconn.php');
date_default_timezone_set('Asia/Kolkata');

$current_time = date("H:i:s");  // Use 24-hour format for comparison
$currentDate = date('Y-m-d');

$get_time_date = pg_query($db, "SELECT lottery_date, lottery_time, lottery_file FROM lottery_date_time WHERE lottery_status='1' AND lottery_date >='$currentDate'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-cover bg-no-repeat bg-center" style="background-image: url('viewimg.jpg');">
    <div class="grid justify-center items-center h-screen">
        <?php
        if (pg_num_rows($get_time_date) > 0) {
            $i = 0;
            while (list($lott_date, $lott_time, $lott_file) = pg_fetch_array($get_time_date)) {
        ?>
                <div class="relative flex flex-col h-80 items-center mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-96 relative bottom-2.5">

                    <div class="p-6">
                        <?php if ($i == 0) { ?>
                            <p class="text-2xl mb-10 text-center">Winner List </p>
                        <?php } ?>
                        <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            <?= $lott_date . ' ' . $lott_time ?>
                        </h5>
                        <p class="block font-sans text-base antialiased font-light  leading-relaxed text-inherit">
                            You can download the result once the mentioned time reaches
                        </p>
                    </div>
                    <div class="p-6 pt-0 mt-6">
                        <?php if (strtotime($currentDate) >= strtotime($lott_date) && strtotime($current_time) >= strtotime($lott_time)) { ?>
                            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href="download.php?lott_file=<?= $lott_file ?>"><?= $lott_file ?></a></button>
                        <?php } else {
                            $updQry = pg_query($db, "UPDATE lottery_date_time SET lottery_status='0' WHERE lottery_date != '$currentDate'") or die(preg_last_error($db));
                        ?>
                            <button class="border p-4">Result Coming Soon</button>
                        <?php } ?>
                    </div>

                </div>
        <?php
                $i++;
            }

        ?>
    </div>
<?php } else { ?>

    <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-96">

        <div class="p-6">
            <p class="text-2xl mb-10 text-center">Winner List </p>
            <h5 class="block mb-2 font-sans text-xl text-center antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                No Records Found
            </h5>
            <p class="block font-sans text-base antialiased font-light leading-relaxed text-inherit">
            </p>
        </div>
        <div class="p-6 pt-0">
            <P class="border b-4 text-center p-6 mb-4">Results will update soon</P>
        </div>


    </div>

<?php } ?>
</div>
</body>

</html>
