function cleanGrupos() {
    try {
        tablaGruposAdmin.remove();
    } catch (e) {
        if (e instanceof ReferenceError) {
            // Handle error as necessary
        } else {
            console.log(e);
            swal("Upps...", "Algo ha fallado!\n\nIntenta de Nuevo :D", "error");
            return null;
        }
    }
}

async function getGrupos() {
    let nombre = '#getGruposAdmin';
    let datos = $(nombre).serialize();
    let w;
    await $.ajax({
        type: "POST",
        url: "partials/getGrupos.php",
        data: datos,
        success: function (r) {
            w = r;
            switch (r) {
                case '\"\"':
                    swal("Grupo no encontrado!", "Intenta de Nuevo :D", "info");
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

async function getCatequistasxGrupo(idGrupo) {
    let datos = idGrupo;
    let w;
    await $.ajax({
        type: "POST",
        url: "partials/getGrupoCatequistas.php",
        data: datos,
        success: function (r) {
            w = r;
            switch (r) {
                case '\"\"':
                    swal("Grupo no encontrado!", "Intenta de Nuevo :D", "info");
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

async function consultaGruposAdmin() {

    cleanGrupos();
    let data = getGrupos();
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
            let htmlText = '<div class="table-responsive my-1"><table id="tablaGruposAdmin" class="table table-striped">' +
                '<thead>' +
                '<tr>' +
                '<th scope="col" class="text-center fst-italic">Nombre del Grupo</th>' +
                '<th scope="col" class="text-center fst-italic">Parroquia</th>' +
                '<th scope="col" class="text-center fst-italic">Parroco</th>' +
                '<th scope="col" class="text-center fst-italic">Modulo Actual</th>' +
                '<th scope="col" class="text-center fst-italic">Estado</th>' +
                // '<th scope="col" class="text-center fst-italic">Ver Grupo</th>' +
                '<th scope="col" class="text-center fst-italic">Calificar</th>' +
                '<th scope="col" class="text-center fst-italic">Modificar</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            for (let i = 0; i < t.length; i++) {
                htmlText +=
                    '<tr>' +
                    `<td scope="row" class="text-center fw-semibold">${t[i]["nombreGrupo"]}</td>` +
                    `<td class="text-center fw-semibold">${t[i]["nombreParroquia"]}</td>` +
                    `<td class="text-center fw-semibold">${t[i]["nombreParroco"]} ${t[i]["nombre2Parroco"]} ${t[i]["apellidoParroco"]} ${t[i]["apellido2Parroco"]}</td>` +
                    `<td class="text-center fw-semibold">`;
                if (t[i]["moduloActual"] == null || t[i]["moduloActual"] == 0) {
                    htmlText += `<abbr class="initialism" title="El grupo no tiene inicializada su historia académica">- - -</abbr>`;
                } else {
                    htmlText += `${t[i]["moduloActual"]}`;
                }
                htmlText += `</td>`;
                if (t[i]["estadoGrupo"] === "1") {
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

                /*Funcionalidad No implementada */
                // htmlText +=
                //     '<td class="text-center fw-semibold">' +
                //     `<a data-bs-toggle="modal" href="#exampleModal">` +
                //     '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">' +
                //     '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />' +
                //     '</svg>' +
                //     '</a>' +
                //     '</td>';
                htmlText +=
                    '<td class="text-center fw-semibold">' +
                    `<a href="calificaciones/advertencia.php?p$b423scer34432yi$unj1232asds34da34shs!???=${t[i]["idGrupo"]}&a!¡v02ds3ass334de$?!!=1" target="_blank" onclick="window.open(this.href, this.target, 'width=1100,height=650'); return false;">` +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">' +
                    '<path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />' +
                    '<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />' +
                    '<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />' +
                    '</svg>' +
                    '</a>' +
                    '</td>' +

                    '<td class="text-center fw-semibold">' +
                    `<a href="administracion/grupos.php?p$b423scer34432yi$unj1232asds34da34shs!???=${t[i]["idGrupo"]}&a!¡v02ds3ass334de$?!!=1" target="_blank" onclick="window.open(this.href, this.target, 'width=650,height=280'); return false;">` +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">' +
                    '<path d = "M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />' +
                    '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>' +
                    '</svg>' +
                    '</a>' +
                    '</td>' +

                    '</tr>';
            }
            htmlText += '</tbody>' + '</table></div>';

            consultaGruposAdminPane.insertAdjacentHTML('afterbegin', htmlText);
        }
    }).catch(function () {
        swal("Upps...", "Llena las casillas de búsqueda :D", "info");
    });;
}