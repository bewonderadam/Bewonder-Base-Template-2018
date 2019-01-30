<?php
/** Page Template - Find Us **/
get_header(); ?>
<section id="page-header-container">
  <div class="page-header-inner">
    <div class="title-container">
      <div class="title-inner">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
    <section class="page-content">
      <div id="opening-hours-datepicker"></div>
      <div id="opening-times">
        <table id="opening-times-table">
          <tbody>

          </tbody>
        </table>

      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <script type="text/javascript">

        var startDate;
        var endDate;
        var $openingHoursPicker = $('#opening-hours-datepicker');
        var currentDate = new Date();
        var minDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), +1); //one day next before month
        var maxDate =  new Date(currentDate.getFullYear(), currentDate.getMonth() +2, +0); // one day before next month

        var selectCurrentWeek = function () {
          window.setTimeout(function () {
            $openingHoursPicker.find('.ui-datepicker-current-day a').addClass('ui-state-active');
          }, 1);
        }

        function updateWeekStartEnd() {
          var selectedDate = $openingHoursPicker.datepicker('getDate') || new Date();
          startDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate() - selectedDate.getDay() );
          endDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate() - selectedDate.getDay() + 6);
        }

        updateWeekStartEnd();
        selectCurrentWeek();

        $openingHoursPicker.datepicker({
          changeMonth: false,
          changeYear: false,
          stepMonths: false,
          minDate: minDate,
          maxDate: maxDate,
          hideIfNoPrevNext: true,
          duration: '',
          dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
          onSelect: function (dateText, instance) {
            updateWeekStartEnd();
            selectCurrentWeek();
          },
          beforeShowDay: function (date) {
            var cssClass = '';
            if (date >= startDate && date <= endDate) {
              cssClass = 'current-week';
            }
            return [true, cssClass];
          },
          onChangeMonthYear: function (year, month, inst) {
            selectCurrentWeek();
          }
        });

        var date = $openingHoursPicker.datepicker('getDate');
        console.log( date );


        var day = date.getDay() - 1;
        day = (day < 0 ? 6 : day);

        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - day);
        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - day + 6);

        console.log( startDate );
        console.log( endDate );


        $.ajax({
          type: 'GET',
          url: 'http://localhost/base_template_2018/site/wp-json/acf/v3/options/options/standard_opening_times',
          contentType: 'application/json; charset=utf-8',
          dataType: 'json',
          success: function( data ) {
            var standardOpeningTimes = data['standard_opening_times'];
            $.each(data.standard_opening_times, function(index, element) {
              $('table#opening-times-table > tbody').append( '<tr><td class="day">' + element.day + '</td><td class="times">' + element.times + "</td></tr>");
            });
          }
        });


      </script>
    </section>
  </div>
</section>
<?php get_footer(); ?>
