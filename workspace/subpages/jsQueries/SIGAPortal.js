async function getCatequistas() {
    let nombre = '#getCatequistasAdmin';
    let datos = $(nombre).serialize();
    let w;
    await $.ajax({
        type: "POST",
        url: "partials/getCatequistas.php",
        data: datos,
        success: function (r) {
            w = r;
            switch (r) {
                case '\"\"':
                    swal("Catequista no encontrado!", "Intenta de Nuevo :D", "info");
                    return undefined;
                case '-error':
                    swal({
                        title: "Upps...",
                        text: "Ha ocurrido un error al conectar con el servidor! Contacta a Soporte :s (Codigo error: SP-Admin-Cat-101)",
                        icon: "error",
                        buttons: {
                            cancel: "Cancelar",
                            error: "Ver Error"
                        },
                        dangerMode: true,
                    }).then((errorSee) => {
                        switch (errorSee) {
                            case 'error':
                                swal(r);
                                break;
                        }
                    });
                    return undefined;
            }
        }
    });
    // alert(w);
    return w;
}

async function consultaCatequistasAdmin() {
    try {
        prueba.remove();
    } catch (e) {
        if (e instanceof ReferenceError) {
            // Handle error as necessary
        } else {
            console.log(e);
            swal("Upps...", "Algo ha fallado!\n\nIntenta de Nuevo :D", "error");
            return null;
        }
    }
    let data = getCatequistas();
    data.then(function (r) {
        if (r == '\"\"') {
            // } else if (typeof (r) === 'string') {
            //swal(r);
        } else {
            // console.log(r);
            let t = JSON.parse(r);
            // console.log(t);
            // console.log(t[2]);
            // console.log(t[2]['nombreCatequista']);
            let htmlText = '<div class="table-responsive my-1"><table id="prueba" class="table table-striped">' +
                '<thead>' +
                '<tr>' +
                '<th scope="col" class="text-center fst-italic">Documento</th>' +
                '<th scope="col" class="text-center fst-italic">Nombres</th>' +
                '<th scope="col" class="text-center fst-italic">Apellidos</th>' +
                '<th scope="col" class="text-center fst-italic">Parroquia</th>' +
                '<th scope="col" class="text-center fst-italic">Grupo de Trabajo</th>' +
                '<th scope="col" class="text-center fst-italic">Estado</th>' +
                '<th scope="col" class="text-center fst-italic">Modificar</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            for (let i = 0; i < t.length; i++) {
                htmlText +=
                    '<tr>' +
                    `<td scope="row" class="text-center fw-semibold">${t[i]["cedulaCiudadania"]}</td>` +
                    `<td class="text-center fw-semibold">${t[i]["nombreCatequista"]} ${t[i]["nombre2Catequista"]}</td>` +
                    `<td class="text-center fw-semibold">${t[i]["apellidoCatequista"]} ${t[i]["apellido2Catequista"]}</td>` +
                    `<td class="text-center fw-semibold">${t[i]["nombreParroquia"]}</td>` +
                    `<td class="text-center fw-semibold">${t[i]["nombreGrupo"]}</td>`;
                if (t[i]["estadoCatequista"] === "1") {
                    htmlText +=
                        '<td class="text-center fw-semibold">' +
                        '<svg class="bi bi-record-circle-fill text-success mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">' +
                        '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />' +
                        '</svg>' +
                        '<span>' +
                        'Activo' +
                        '</span>' +
                        '</td>';
                } else {
                    htmlText +=
                        '<td class="text-center fw-semibold">' +
                        '<svg class="bi bi-record-circle-fill text-danger mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">' +
                        '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />' +
                        '</svg>' +
                        '<span>' +
                        'Inactivo' +
                        '</span>' +
                        '</td>';
                }
                htmlText +=
                    '<td class="text-center fw-semibold">' +
                    `<a href="administracion/catequistas.php?p$b423scer34432yi$unj1232asds34da34shs!???=${t[i]["idCatequista"]}&a!¡v02ds3ass334de$?!!=1" target="_blank" onclick="window.open(this.href, this.target, 'width = 650, height = 560'); return false;">` +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">' +
                    '<path d = "M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />' +
                    '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>' +
                    '</svg>' +
                    '</a>' +
                    '</td>' +
                    '</tr>';
            }
            htmlText += '</tbody>' + '</table></div>';

            consultaCatequistasAdminPane.insertAdjacentHTML('afterbegin', htmlText);
        }

    });

}