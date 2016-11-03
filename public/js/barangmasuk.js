function tambahstok() {
    var awal = $('#stokawal').val();
    var masuk = $('#stokmasuk').val();
    var akhir = Number(awal) + Number(masuk);
    $('#stokakhir').val(akhir);
};

function hitungharga() {
    var stok = $('#stokmasuk').val();
    var harga= $('#harga').val();
    var subtotal = Number(stok) * Number(harga);
    $('#subtotal').val(subtotal);
};

$(function () {
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-mm-DD',
        clearButton: true,
        time: false,
        switchOnClick: true
    });

    $('.kode-barang').select2({
        placeholder: 'Cari Kode/Nama Barang',
        allowClear: true,
        width: "100%",
        minimumInputLength: 1,
        ajax: {
            url: '/admin/barang/cari',
            dataType: 'json',
            type: 'POST',
            beforeSend: function (xhr) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="_token"]').attr('content'));
            },
            delay: 250,
            data: function(params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data, page) {
                return { results: data };
            },
        },
    })
    .on("change", function() {
        var kode = $('.kode-barang').val();
        $.get('/admin/barang/stok/' + kode, function(data){
            $('#stokawal').val(data.stock);
        });
    });

    $('#addDetail').click(function() {
        $('.table-detail-barang tbody').append(
            var kode = $('.kode-barang').val();
            var awal = Number($('#stokawal').val());
            var masuk = Number($('#stokmasuk').val());
            var akhir = Number($('#stokakhir').val());
            var harga = Number($('#harga'.val()));
            var subtotal = Number($('#subtotal').val());
        );
    });
});
