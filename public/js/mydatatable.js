$(function () {
    $('.table-kategori').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        // lengthChange: false,
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
});
