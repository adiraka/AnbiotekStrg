$(function () {
    $('.table-kategori').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/kategori/lihat',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nmkategori', name: 'nmkategori' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-satuan').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/satuan/lihat',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nmsatuan', name: 'nmsatuan' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-barang').dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                filename: 'Laporan Stock Barang',
                title: 'Laporan Stock Barang PT. Andalas Bioteknologi Saiyo',
                header: true,
                pageSize: 'A4',
                message: 'Berikut adalah laporan stock barang terbaru PT. Andalas Bioteknologi Saiyo :',
                exportOptions: {
                    modifier: {
                        pageMargins: [150, 150, 150, 150],
                        alignment: 'center'
                    },
                    columns: [0,1,2,3,4,5,6],
                    columnGap: 1,
                },
            },
            {
                extend: 'excel',
                filename: 'Laporan Data Stock Barang',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6],
                },
            },
        ],
        procesing: true,
        serverSide: true,
        responsive: true,
        lengthChange: false,
        ajax: '/admin/barang/lihat',
        columns: [
            { data: 'kode', name: 'kode' },
            { data: 'nmbarang', name: 'nmbarang' },
            { data: 'kategori_id', name: 'kategori_id' },
            { data: 'merk', name: 'merk' },
            { data: 'stock', name: 'stock' },
            { data: 'satuan_id', name: 'satuan_id' },
            { data: 'ket', name: 'ket' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-masuk').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/masuk/lihat',
        columns: [
            { data: 'nobon', name: 'nobon' },
            { data: 'supplier', name: 'supplier' },
            { data: 'tglmasuk', name: 'tglmasuk' },
            { data: 'totbay', name: 'totbay' },
            { data: 'ket', name: 'ket' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-keluar').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/keluar/lihat',
        columns: [
            { data: 'nobon', name: 'nobon' },
            { data: 'pemesan', name: 'pemesan' },
            { data: 'tglkeluar', name: 'tglkeluar' },
            { data: 'totbay', name: 'totbay' },
            { data: 'ket', name: 'ket' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
});
