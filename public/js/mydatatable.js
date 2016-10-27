$(function () {
    $('.table-kategori').dataTable({
        procesing: true,
        serverSide: true,
        responsive: true,
        lengthChange: false,
        ajax: '/admin/kategori/lihat',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nmkategori', name: 'nmkategori' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', searchable: false },
        ]
    });
});
