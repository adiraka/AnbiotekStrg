function kurangstok() {
    var awal = $('#stokawal').val();
    var keluar = $('#stokkeluar').val();
    if (Number(keluar) > Number(awal)) {
        var akhir = 0;
        alert('Stok yang ada tidak mencukupi.!');
    } else {
        var akhir = Number(awal) - Number(keluar);
    }
    $('#stokakhir').val(akhir);
};

function hitungharga() {
    var stok = $('#stokkeluar').val();
    var harga= $('#harga').val();
    var subtotal = Number(stok) * Number(harga);
    $('#subtotal').val(subtotal);
};

function hapus_row() {
    var par = $(this).parent().parent();
    par.remove();
    var total = 0;
    $('.subtotal').each(function(){
        total += 1*($(this).val());
    });
    $('#grandtotal').val(total);
};

$(function () {
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY/MM/DD',
        clearButton: true,
        time: false,
        switchOnClick: true
    });

    $('.kode-barang').select2({
        placeholder: 'Cari Kode/Nama Barang',
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
            $('#nmbarang').val(data.nmbarang);
            $('#merk').val(data.merk);
            $('#stokawal').val(data.stock);
        });
    });

    $('.pelanggan_id').select2({
        placeholder: 'Cari Pelanggan',
        width: "100%",
        ajax: {
            url: '/admin/pelanggan/cari',
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
    });

    $('.status').select2({
        width: "100%",
    });

    $('#status').on("change", function() {
        if ($('#status').val() == 'Lunas') {
            $('#tgllunas').removeAttr('readonly');
        } else if ($('#status').val() == 'Belum Lunas') {
            $('#tgllunas').val(null);
            $('#tgllunas').attr('readonly', 'readonly'); 
        }
    });

    $('#detailBarangModal').on('show.bs.modal', function (e) {
        $('#formDetail').trigger('reset');
        $('.kode-barang').val(null).trigger("change");
        var validator = $( "#formDetail" ).validate();
        validator.resetForm();
    });

    $('#addDetail').click(function() {
        if($('#formDetail').valid()) {
            var kode = $('.kode-barang').val();
            var nama = $('#nmbarang').val();
            var merk = $('#merk').val();
            var awal = Number($('#stokawal').val());
            var keluar = Number($('#stokkeluar').val());
            var akhir = Number($('#stokakhir').val());
            var harga = Number($('#harga').val());
            var subtotal = Number($('#subtotal').val());

            $('.table-detail-barang tbody').append(
                '<tr class="subdata">' +
                '<td><input type="text" name="kode[]" class="xxx" value="'+kode+'" width="2%" readonly></td>' +
                '<td><input type="text" class="xxx" value="'+nama+'" readonly></td>' +
                '<td><input type="text" class="xxx" value="'+merk+'" readonly></td>' +
                '<input type="hidden" name="awal[]" class="xxx" value="'+awal+'" readonly>' +
                '<td><input type="text" name="keluar[]" class="xxx" value="'+keluar+'" readonly></td>' +
                '<input type="hidden" name="akhir[]" class="xxx" value="'+akhir+'" readonly>' +
                '<td><input type="text" name="harga[]"class="xxx" value="'+harga+'" readonly></td>' +
                '<td><input type="text" name="subtotal[]" class="xxx subtotal" value="'+subtotal+'" readonly></td>' +
                '<td><button type="button" class="btn btn-xs btn-danger hapus"><i class="material-icons">clear</i></button></td>' +
                '</tr>'
            );

            var total = 0;
            $('.subtotal').each(function(){
                total += 1*($(this).val());
            });
            $('#grandtotal').val(total);

            $('.hapus').bind("click", hapus_row);
            $('#formDetail').trigger('reset');
            $('.kode-barang').val(null).trigger("change");
            $('#detailBarangModal').modal('hide');
        }
    });
});
