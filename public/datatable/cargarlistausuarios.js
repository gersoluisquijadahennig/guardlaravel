$(function () {
    // Destroy existing DataTable instance
    $('#Table').DataTable().destroy();

    // Create a new DataTable instance with ajax configuration
    let table = $('#Table').DataTable({
        ajax: {
            url: 'http://10.8.117.29:8082/datosListaUsuarios',
            dataSrc: 'data',
            headers: {
                'Content-Type': 'application/json'
            }
        },
        columns: [
            { data: 'id' },
            { data: 'usuario' },
            { data: 'correo_electronico' },
            { data: 'activo' },
        ]
    });

    // Add click event handler for the table rows
    $('#Table tbody').on('click', 'tr', function () {
        let data = table.row(this).data();
        alert('You clicked on ' + data.id + "'s row");
    });
});

var table = $('#example').DataTable();
 
$('#example tbody').on('click', 'tr', function () {
    var data = table.row(this).data();
 
    alert('You clicked on ' + data[0] + "'s row");
});

