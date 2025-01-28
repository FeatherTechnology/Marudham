$(document).ready(function () {
    
    $('#from_date').change(function(){
        const fromDate = $(this).val();
        const toDate = $('#to_date').val();
        $('#to_date').attr('min', fromDate);

         // Check if from_date is greater than to_date
        if (toDate && fromDate > toDate) {
            $('#to_date').val(''); // Clear the invalid value
        }
    });

    $('#sel_screen option').hide();
    $('#sel_screen option[value=""]').show(); // Show the 'Select Screen' option


    $('#type').change(function () {
        let type = $(this).val();
        
        if(type == '1'){ // If Cancel is selected
            $('#sel_screen .all-options').show(); 
            $('#sel_screen .cancel-option').show(); 
        } else {
           
            $('#sel_screen .all-options').hide();
            $('#sel_screen .cancel-option').show(); 
        }
    });
    // var cancel_revoke_table = 
    $('#reset_btn').click(function () {
        // Get the values of the input fields
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var type = $('#type').val();
        var sel_screen = $('#sel_screen').val();
    
        // Check if all fields are selected
        if (from_date === '' || to_date === '' || type === '' || sel_screen === '') {
            // If any field is empty, show an alert
            swalError('Warning','Please select all required fields')
        } else {
            // If all fields are filled, reload the table
            // cancel_revoke_table.ajax.reload();
            cancelRevokeTable();
        }
    });


});
//alert message
function swalError(title, text) {
	Swal.fire({
		icon: 'error',
		title: title,
		text: text,
        confirmButtonColor: '#009688',
	})
}

function cancelRevokeTable(){
    $('#cancel_revoke_table').DataTable().destroy();
    $('#cancel_revoke_table').DataTable({
        "order": [
            [0, "desc"]
        ],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'reportFile/cancel_revoke/getCancelRevokeReport.php',
            'data': function (data) {
                var search = $('input[type=search]').val();
                data.search = search;
                data.from_date = $('#from_date').val();
                data.to_date = $('#to_date').val();
                data.type = $('#type').val();
                data.sel_screen = $('#sel_screen').val();
            }
        },
        dom: 'lBfrtip',
        buttons: [{
            extend: 'excel',
            title: "Request Report List"
        },
        {
            extend: 'colvis',
            collectionLayout: 'fixed four-column',
        }
        ],
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        'drawCallback': function () {
            searchFunction('cancel_revoke_table');
        },
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api();

            // Remove formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Array of column indices to sum
            var columnsToSum = [9];

            // Loop through each column index
            columnsToSum.forEach(function (colIndex) {
                // Total over all pages for the current column
                var total = api
                    .column(colIndex)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer for the current column
                $(api.column(colIndex).footer()).html(`<b>` + total.toLocaleString() + `</b>`);
            });
        }
    });
}