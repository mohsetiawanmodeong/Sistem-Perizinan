// View Datatable Category
$(document).ready(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
            iStart: oSettings._iDisplayStart,
            iEnd: oSettings.fnDisplayEnd(),
            iLength: oSettings._iDisplayLength,
            iTotal: oSettings.fnRecordsTotal(),
            iFilteredTotal: oSettings.fnRecordsDisplay(),
            iPage: Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            iTotalPages: Math.ceil(
                oSettings.fnRecordsDisplay() / oSettings._iDisplayLength
            ),
        };
    };

    $("#tablePerizinan").DataTable({
        initComplete: function() {
            var api = this.api();
            $("#datatables input")
                .off(".DT")
                .on("keyup.DT", function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
        },
        oLanguage: {
            sProcessing: "loading...",
        },
        info: false,
        // paginate: false,
        filter: false,
        responsive: true,
        lengthChange: false,
        ordering: false,
        pageLength: 10,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        autoWidth: false,
        order: [], //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "jsonPerizinan",
            type: "POST",
        },
        columns: [{
                data: "id_perizinan",
                className: "text-center",
                orderable: false,
            },
            {
                data: "nama_perizinan",
                className: "text-left",
                orderable: false,
            },
            {
                data: "id_perizinan",
                className: "text-center",
                render: function(id_perizinan, type, full, meta) {
                    return (
                        '<a href="editPerizinan/' +
                        id_perizinan +
                        '" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> </a> <a href="deletePerizinan/' +
                        id_perizinan +
                        '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>'
                    );
                },
            },
        ],

        order: [
            [0, "asc"]
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $("td:eq(0)", row).html(index);
        },
    });
});