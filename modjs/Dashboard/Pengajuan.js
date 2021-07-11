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

    $("#tablePengajuan").DataTable({
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
            url: "jsonPengajuan",
            type: "POST",
        },
        columns: [{
                data: "id_pengajuan",
                className: "text-center",
                orderable: false,
            },
            {
                data: "nama_perizinan",
                className: "text-left",
                orderable: false,
            },
            {
                data: "tgl_pengajuan",
                className: "text-center",
                orderable: false,
                render: function(data, type, full) {
                    return moment(data).format("DD MMMM YYYY");
                },
            },
            {
                data: "nama_perusahaan",
                className: "text-center",
                orderable: false,
            },
            {
                data: "tgl_disetujui",
                className: "text-center",
                render: function(data, type, full) {
                    if(data === "0000-00-00"){
                        return '-';
                    }else{
                        return moment(data).format("DD MMMM YYYY");
                    }
                },
            },
            {
                data: "keterangan",
                className: "text-center",
                render: function(data, type, row) {
                    if (data === "Pengajuan Perizinan") {
                        return '<font style="color:blue">'+data+'</font>';
                    }else if(data === "Sedang Di Proses Admin"){
                        return '<font style="color:purple">'+data+'</font>';
                    }else if(data === "Di Setujui"){
                        return '<font style="color:green">'+data+'</font>';
                    }else if(data === "Pending"){
                        return '<font style="color:gray">'+data+'</font>';
                    } else {
                        return '<font style="color:red">'+data+'</font>';
                    }
                },
            },
            {
                data: "catatan",
                className: "text-center",
                orderable: false,
            },
            {
                data: "id_pengajuan",
                className: "text-center",
                render: function(id_pengajuan, type, full, meta) {
                    return (
                        '<a href="editPengajuan/'+id_pengajuan+'" class="btn btn-info btn-sm"><i class="fa fa-check fa-fw"></i> </a> <a href="deletePengajuan/' +
                        id_pengajuan +
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