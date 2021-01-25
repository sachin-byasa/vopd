  $(function() {

    var start;
    var end;
    var current_year_to_date;

    function cb(start, end) {
       document.getElementById("reportrange").value =start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY');

    }

    if (moment().month() <= moment().month('April')) {
      current_year_to_date = moment().subtract('year', 1).month('April').startOf('month');
      
    } else {
      current_year_to_date = moment().month('April').startOf('month');
    };

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last Week':[moment().subtract(1, 'weeks').startOf('week'),moment().subtract(1, 'weeks').endOf('week')],
          'This Week': [moment().day("Sunday"), moment().day("Saturday")],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Current Quarter': [moment().quarter(moment().quarter()).startOf('quarter'), moment().quarter(moment().quarter()).endOf('quarter')],
          'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
          'Year to date':[current_year_to_date]
          
        },
        locale: {
            format: 'DD/MM/YYYY'
        }
    }, cb);

    cb(startDate, endDate);

});