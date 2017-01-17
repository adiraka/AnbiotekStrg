$(function () {
    $('.table-kategori').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/kategori/lihat',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nmkategori', name: 'nmkategori' },
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
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-merk').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/merk/lihat',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nmmerk', name: 'nmmerk' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-distributor').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/distributor/lihat',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nmdistributor', name: 'nmdistributor' },
            { data: 'telepon', name: 'telepon' },
            { data: 'alamat', name: 'alamat' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-pelanggan').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/pelanggan/lihat',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nmpelanggan', name: 'nmpelanggan' },
            { data: 'telepon', name: 'telepon' },
            { data: 'alamat', name: 'alamat' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
    $('.table-barang').dataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     {
        //         extend: 'pdfHtml5',
        //         filename: 'Laporan Stock Barang',
        //         title: 'Laporan Stock Barang PT. Andalas Bioteknologi Saiyo',
        //         header: true,
        //         pageSize: 'A4',
        //         message: 'Berikut adalah laporan stock barang terbaru PT. Andalas Bioteknologi Saiyo :',
        //         exportOptions: {
        //             modifier: {
        //                 pageMargins: [150, 150, 150, 150],
        //                 alignment: 'center'
        //             },
        //             columns: [0,1,2,3,4,5,6],
        //             columnGap: 1,
        //         },
        //     },
        //     {
        //         extend: 'excel',
        //         filename: 'Laporan Data Stock Barang',
        //         exportOptions: {
        //             columns: [0,1,2,3,4,5,6],
        //         },
        //     },
        // ],
        procesing: true,
        serverSide: true,
        responsive: true,
        ajax: '/admin/barang/lihat',
        columns: [
            { data: 'kode', name: 'kode' },
            { data: 'kategori_id', name: 'kategori_id' },
            { data: 'nmbarang', name: 'nmbarang' },
            { data: 'merk_id', name: 'merk_id' },
            { data: 'stock', name: 'stock' },
            { data: 'satuan_id', name: 'satuan_id' },
            { data: 'expire', name: 'expire' },
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
            { data: 'distributor_id', name: 'distributor_id' },
            { data: 'tglmasuk', name: 'tglmasuk' },
            { data: 'status', name: 'status' },
            { data: 'tgllunas', name: 'tgllunas' },
            { data: 'totbay', name: 'totbay' },
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
            { data: 'pelanggan_id', name: 'pelanggan_id' },
            { data: 'tglkeluar', name: 'tglkeluar' },
            { data: 'status', name: 'status' },
            { data: 'tgllunas', name: 'tgllunas' },
            { data: 'totbay', name: 'totbay' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
});
