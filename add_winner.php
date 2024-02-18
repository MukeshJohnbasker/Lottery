<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.3/dist/flowbite.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.3/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.3/dist/datepicker.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>
 
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
 
    <script src=
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
    </script>
    <link rel="stylesheet" href="clock.css">
</head>

<body class="h-14 bg-gradient-to-r from-purple-500 to-pink-500">
<div class="flex justify-center items-center min-h-screen ">
    <div class="w-full md:w-1/2 p-4">
        <form class="bg-white shadow-md rounded px-4 pt-6 pb-8 mb-4 md:my-32 p-10">
            <div class="text-3xl text-center mb-10">Admin Page</div>
            <div class="grid gap-4 md:gap-8 grid-cols-1 md:grid-cols-2">
                <div class="container ">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                        Date of Lottery
                    </label>
                    <input type="text" id="lottery_date" class="w-full p-2.5 rounded-lg focus:ring-blue-500 focus:border-blue-500" readonly="readonly" placeholder="Date">
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                        Time
                    </label>
                    <input id="input" class="w-full p-2.5 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Select Time"/>
                </div>
                <div>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="lottery_file" type="file">
                </div>
                <div>
                <a href="lott_view_list.php"><button type="button" class="w-full text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">View List</button></a>
                </div>
                <div class="col-span-2">
                <button type="button" id="get_time_date" onclick="get_date_time()" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Button</button>
                </div>
            </div>
        </form>
        <p class="text-center text-grey text-xs">
            © 2018 Acme Corp. All rights reserved.
        </p>
    </div>
</div>


<!-- Include jQuery library -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

<script>
            $(document).ready(function () {
 
 $(function () {
     $("#lottery_date").
     datepicker();
 });
}) 
    function get_date_time() {
        console.log("tst");
        var lott_date = $("#lottery_date").val();
        var lott_time = $("#input").val();
        console.log("lott_time"+lott_time);
        var lott_file = $("#lottery_file")[0].files[0];
        console.log(lott_file);

        // Create FormData object to send files and other data
        var formData = new FormData();
        formData.append('lottery_date', lott_date);
        formData.append('lottery_time', lott_time);
        formData.append('lottery_file', lott_file);
        formData.append('action', 'Insert_date_time');

        // Make AJAX request
        $.ajax({
            url: 'lott_ins_dete_time.php',  // Replace with the actual server-side script URL
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.trim() === 'success') {
                    alert("Data Updated Successfully");
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    }

        $.widget('wx.timepicker', {
            _create: function() {
                this.timepicker = $('<div class="timepicker"><div class="clock"><div class="unit hour bubble">Hr</div><div class="unit minute bubble">Min</div><div class="face"><div class="time-bubbles"></div><div class="minute hand"></div><div class="hour hand"></div></div><div class="meridiem am bubble">AM</div><div class="meridiem pm bubble">PM</div></div><div class="done">Done</div></div>').hide().insertAfter(this.element);
                this.hour = 0;
                this.minute = 0;
                this.meridiem = 0; // 0=am, 1=pm
                this.display = 0; // 0=none, 1=hours, 2=minutes
                this.isOpen = false;
                var self = this;

                this.element.prop('autocomplete', false);
                if (self._parseInput()) {
                    self._refreshAll();
                }
                this.timepicker.find('.unit.minute').on('click', function() {
                    self._buildMinutes();
                });
                this.timepicker.find('.unit.hour').on('click', function() {
                    self._buildHours();
                });
                this.timepicker.on('click', '.time.hour', function() {
                    self.hour = $(this).data('value');
                    self._buildMinutes();
                    self._refreshAll();
                });
                this.timepicker.on('click', '.time.minute', function() {
                    self.minute = $(this).data('value');
                    self._refreshAll();
                });
                this.element.on('focus click', function() {
                    self._open();
                });
                this.timepicker.on('mousedown', function(e) {
                    return false;
                });
                this.element.on('blur', function(e) {
                    self._parseInput();
                    self._refreshInput();
                    self._close();
                });
                this.element.on('input', function() {
                    if (self._parseInput()) {
                        self._refreshClock();
                    }
                });
                this.timepicker.find('.done').on('click', function() {
                    self.element.focus();
                    self._close();
                });
                this.timepicker.find('.meridiem.am').on('click', function() {
                    self.meridiem = 0;
                    self._refreshAll();
                });
                this.timepicker.find('.meridiem.pm').on('click', function() {
                    self.meridiem = 1;
                    self._refreshAll();
                });
            },

            _open: function() {
                if (!this.isOpen) {
                    var offset = this.element.offset();
                    this.timepicker.css({
                        'left': offset.left + 'px',
                        'top': (offset.top + this.element.outerHeight()) + 'px'
                    }).show();
                    this.isOpen = true;
                    this._buildHours();
                }
            },

            _close: function() {
                if (this.isOpen) {
                    this.timepicker.hide();
                    this.isOpen = false;
                }
            },

            _refreshAll: function() {
                this._refreshInput();
                this._refreshClock();
            },

            _refreshInput: function() {
                var hour = this.hour === 0 ? 12 : this.hour;
                var minute = this.minute < 10 ? '0' + this.minute : this.minute;
                this.element.val(hour + ':' + minute + ' ' + (this.meridiem ?  'PM' : 'AM'));
            },

            _refreshClock: function() {
                var self = this;
                if (this.meridiem) {
                    this.timepicker.find('.meridiem.am').removeClass('selected');
                    this.timepicker.find('.meridiem.pm').addClass('selected');
                } else {
                    this.timepicker.find('.meridiem.pm').removeClass('selected');
                    this.timepicker.find('.meridiem.am').addClass('selected');
                }
                this.timepicker.find('.time.selected').removeClass('selected');
                if (this.display === 1) {
                    this.timepicker.find('.time.hour').filter(function() {
                        return $(this).data('value') === self.hour;
                    }).addClass('selected');
                } else {
                    this.timepicker.find('.time.minute').filter(function() {
                        return $(this).data('value') === self.minute;
                    }).addClass('selected');
                }
                this.timepicker.find('.hand.hour').css('transform', 'rotate(' + (this.hour / 12 * 360) + 'deg)');
                this.timepicker.find('.hand.minute').css('transform', 'rotate(' + (this.minute / 60 * 360) + 'deg)');
            },

            _parseInput: function() {
                var time = $.trim(this.element.val());
                var match;
                var valid = false;
                this.hour = 0;
                this.minute = 0;
                this.meridiem = 0;
                if (time.length > 0 && (match = /^(\d{1,2})(?::?(\d{2}))?(?: ?([ap])\.?(?:m\.?)?)?$/i.exec(time))) {
                    valid = true;
                    this.hour = parseInt(match[1]);
                    this.minute = match[2] ? parseInt(match[2]) : 0;
                    if (match[3] && match[3].toLowerCase() === 'p') {
                        this.meridiem = 1;
                    }
                }
                if (this.minute >= 60) {
                    this.hour += Math.floor(this.minute / 60);
                    this.minute = this.minute % 60;
                }
                if (this.hour >= 12) {
                    this.meridiem = 1;
                    this.hour = this.hour % 12;
                }
                return valid;
            },

            _buildHours: function() {
                if (this.display === 1) return;
                this.display = 1;
                var r = this.timepicker.find('.face').width() / 2;
                var j = r - 22;
                var bubbles = [];
                for (var hour = 0; hour < 12; ++hour) {
                    var x = j * Math.sin(Math.PI * 2 * (hour / 12));
                    var y = j * Math.cos(Math.PI * 2 * (hour / 12));
                    var bubble = $('<div>', {
                            'class': 'time hour bubble'
                        })
                        .text(hour == 0 ? 12 : hour)
                        .css({
                            marginLeft: (x + r - 15) + 'px',
                            marginTop: (-y + r - 15) + 'px'
                        })
                        .data('value', hour);
                    if (this.hour === hour) bubble.addClass('selected');
                    bubbles.push(bubble);
                }
                this.timepicker.find('.time-bubbles').html(bubbles);
                this.timepicker.find('.minute.hand').removeClass('selected');
                this.timepicker.find('.minute.unit').removeClass('selected');
                this.timepicker.find('.hour.hand').addClass('selected').appendTo(this.timepicker.find('.face'));
                this.timepicker.find('.hour.unit').addClass('selected');
            },

            _buildMinutes: function() {
                if (this.display === 2) return;
                this.display = 2;
                var r = this.timepicker.find('.face').width() / 2;
                var j = r - 22;
                var bubbles = [];
                for (var min = 0; min < 60; min += 5) {
                    var str = min < 10 ? '0' + min : String(min);
                    var x = j * Math.sin(Math.PI * 2 * (min / 60));
                    var y = j * Math.cos(Math.PI * 2 * (min / 60));
                    var bubble = $('<div>', {
                            'class': 'time minute bubble'
                        })
                        .text(str)
                        .css({
                            marginLeft: (x + r - 15) + 'px',
                            marginTop: (-y + r - 15) + 'px'
                        })
                        .data('value', min);
                    if (this.minute === min) bubble.addClass('selected');
                    bubbles.push(bubble);
                }
                this.timepicker.find('.time-bubbles').html(bubbles);
                this.timepicker.find('.hour.hand').removeClass('selected');
                this.timepicker.find('.hour.unit').removeClass('selected');
                this.timepicker.find('.minute.hand').addClass('selected').appendTo(this.timepicker.find('.face'));
                this.timepicker.find('.minute.unit').addClass('selected');
            }
        });

        $('#input').timepicker();
    </script>
</body>

</html>