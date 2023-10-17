let isEdit = false;

const handleGet = () => {

    $.ajax({
        type: "GET",
        url: "./src/Controllers/FilmController.php",
        success: function (response) {
            // Manejar la respuesta del servidor
            if (!response) {
                alert("Algo ha salido mal")
            } else {
                const filmList = $("#film-list");
                data = JSON.parse(response)

                console.log(data)
                if (Object.keys(data).length <= 0) {
                    console.log("no se ve lista")
                    $("#section-film-form").css("display", "block")
                } else {
                    $("#section-films-list").css("display", "block")
                    // console.log("mostar lista")

                    const checkActive = data.every((film) => !film.isActive);

                    if (checkActive) {
                        // Realiza alguna acción si todas las películas están inactivas
                        console.log("Todas las películas están inactivas.");

                        showForm();
                    }



                    for (const key in data) {
                        if (Object.hasOwnProperty.call(data, key)) {
                            const film = data[key];
                            // console.log(film)
                            if (film.isActive) {
                                newElem = `<div class="list">
                                <div class="list-block">${film.title}</div>
                                <div class="list-block">${film.description}</div>
                                <div class="list-block">${film.year}</div>         
                                <div class="list-block list-block-actions">
                                    <button onclick="handlePut(${film.id})">Editar</button>
                                    <button onclick="handleDel(${film.id})">Eliminar</button>
                                </div>
                            </div>`


                                filmList.append(newElem)
                            }
                        }

                    }
                }
            }
        }
    });
}

const handleGetById = (id) => {
    console.log(id)
    $.ajax({
        type: "GET",
        url: `./src/Controllers/FilmController.php?id=${id}`,
        success: function (response) {
            if (response) {
                data = JSON.parse(response)
                const { title, description, year } = data[0];


                if (isEdit) {
                    const filmForm = $("#film-form")
                    const inputTitle = $("#film-form #title")
                    const inputDesc = $("#film-form #description")
                    const inputYear = $("#film-form #year")
                    const button = $("#film-form [type='submit']");


                    inputTitle.val(title)
                    inputDesc.val(description)
                    inputYear.val(year)
                    button.val("Editar Película")

                    filmForm.off()

                    filmForm.submit(function (event) {
                        event.preventDefault(); // Prevenir el envío del formulario estándar

                        // Recopilar datos del formulario
                        const formData = new FormData(this);
                        const data = {}

                        for (const [key, value] of formData) {
                            data[key] = value
                        }

                        $.ajax({
                            type: "PUT",
                            url: `./src/Controllers/FilmController.php?id=${id}`,
                            data: JSON.stringify(data),
                            processData: false,
                            contentType: false,
                            success: function (response) {

                                console.log(response)
                                // Manejar la respuesta del servidor
                                if (response == 1) {
                                    alert("Datos Actualizados correctamente")
                                } else {
                                    alert("Algo ha salido mal")
                                }

                                location.reload()

                            }
                        });
                    });
                }

            } else return "Ha habido un Error"
        }
    });

}

const handlePost = () => {
    const filmForm = $("#film-form")

    filmForm.submit(function (event) {
        event.preventDefault(); // Prevenir el envío del formulario estándar

        // Recopilar datos del formulario
        const formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./src/Controllers/FilmController.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Manejar la respuesta del servidor
                if (response == 1) {
                    alert("Datos insertados correctamente")
                } else {
                    alert("Algo ha salido mal")
                }

                location.reload()

            }
        });
    });
}

const handlePut = (id) => {
    console.log(id)

    isEdit = true;

    handleGetById(id)
    showForm();

}

const handleDel = (id) => {

    const confirmation = confirm("¿Estas seguro que quieres eliminar este resultado?")

    if (!confirmation) return;

    $.ajax({
        type: "DELETE",
        url: `./src/Controllers/FilmController.php?id=${id}`,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response)
            // Manejar la respuesta del servidor
            if (response == 1) {
                alert("Datos Borrados correctamente")
            } else {
                alert("Algo ha salido mal")
            }

            location.reload()

        }
    });
}

const showForm = () => {

    $("#section-film-form").css("display", "block")
    $("#section-films-list").css("display", "none")
}


$(document).ready(function () {
    // console.log("ready");

    $("#add-film-btn").click(() => showForm())

    handleGet();
    handlePost();

});
