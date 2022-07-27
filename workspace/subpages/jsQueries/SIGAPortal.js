function consultaCatequistasAdmin() {
    try {
        prueba.remove();
    } catch (e) {
        if (e instanceof ReferenceError);
    }
    let htmlText = '<div class="table-responsive my-2"><table id="prueba" class="table table-striped">' +
        '<thead>' +
        '<tr>' +
        '<th scope="col" class="text-center fst-italic">D.I.</th>' +
        '<th scope="col" class="text-center fst-italic">Nombres</th>' +
        '<th scope="col" class="text-center fst-italic">Apellidos</th>' +
        '<th scope="col" class="text-center fst-italic">Parroquia</th>' +
        '<th scope="col" class="text-center fst-italic">Grupo de Trabajo</th>' +
        '<th scope="col" class="text-center fst-italic">Estado</th>' +
        '<th scope="col" class="text-center fst-italic">Modificar</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';

    for (let i = 0; i < 3; i++) {
        htmlText +=
            '<tr>' +
            '<td scope="row" class="text-center fw-semibold">1000518043</td>' +
            '<td class="text-center fw-semibold">Cristian Camilo</td>' +
            '<td class="text-center fw-semibold">Vargas Morales</td>' +
            '<td class="text-center fw-semibold">Nuestra Señora de la Salud</td>' +
            '<td class="text-center fw-semibold">Cesar</td>' +
            '<td class="text-center fw-semibold">' +
            '<svg class="bi bi-record-circle-fill text-success mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">' +
            '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />' +
            '</svg>' +
            '<span>' +
            'Activo' +
            '</span>' +
            '</td>' +
            '<td class="text-center fw-semibold">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">' +
            '<path d = "M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />' +
            '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>' +
            '</svg>' +
            '</td>' +
            '</tr>';
    }
    htmlText += '</tbody>' + '</table></div>';

    consultaCatequistasAdminPane.insertAdjacentHTML('afterbegin', htmlText);
}