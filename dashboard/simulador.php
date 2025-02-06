<?php require_once "parte_superior.php" ?>

<!--INICIO del cont principal-->
<style>
    .tabs {
        display: flex;
        cursor: pointer;
        padding: 10px;
        background-color: #f1f1f1;
    }
    .tab {
        margin: 0 10px;
        width: 5em;
        display: flex;
        justify-content: center;
    }
    .tab:hover {
        background-color: #ccc;
    }
    .tab-content {
        display: none;
        padding: 20px;
        border-top: 1px solid #ccc;
        background-color: #f9f9f9;
    }
    .active-tab {
        color: blue;
    }
    .active-content {
        display: block;
    }
    .formContent {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        display: none;
    }
</style>

<div class="content">
    <br>
    <div class="tabs">
        <div class="tab" onclick="openTab(event, 'tab1')">
            Crédito
        </div>
        <div class="tab" onclick="openTab(event, 'tab2')">
            Ahorro
        </div>
        <div class="tab" onclick="openTab(event, 'tab3')">
            Inversión
        </div>
    </div>

    <div id="tab1" class="tab-content">
        <form id="myForm1">
            <h1 style="text-align:center;font-size: 1.4em;font-weight: 700;">Simulador de Crédito</h1>
            <label for="name">Monto Total</label>
            <input class="form-control" type="text" id="couta1" name="couta" required><br>
            <label for="fecha">Fecha de Inicio</label>
            <input class="form-control" type="date" id="fecha" name="fecha" required><br>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <div id="formContent1" class="formContent">
            <h1 style="text-align:center;font-size: 1.4em;font-weight: 700;">Simulador de crédito</h1><br>
            <p><strong>Fecha de inicio:</strong> <span id="fechaInicial"></span></p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha de Pago</th>
                        <th scope="col">Cuota Base</th>
                        <th scope="col">Intereses</th>
                        <th scope="col">Total por Cuota</th>
                    </tr>
                </thead>
                <tbody id="tableBody1"></tbody>
            </table>
        </div>
    </div>

    <div id="tab2" class="tab-content">
        <form id="myForm2">
            <h1 style="text-align:center;font-size: 1.4em;font-weight: 700;">Simulador de Ahorro</h1><br>
            <label for="name">Monto</label>
            <input class="form-control" type="text" id="couta2" name="couta"><br>
            <label for="years">Tiempo a pagar</label>
            <select class="form-control" type="number" id="years2" name="years" min="1" max="30" required>
                <option value="0.5">6 meses</option>
                <option value="1">1 año</option>
            </select>
            <br>
            <label for="fecha">Fecha de Inicio</label>
            <input class="form-control" type="date" id="fecha" name="fecha" required><br>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <div id="formContent2" class="formContent">
            <h1 style="text-align: center;">Simulador de ahorro</h1><br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha de Pago</th>
                        <th scope="col">Cuota Base</th>
                        <th scope="col">Intereses</th>
                        <th scope="col">Total por Cuota</th>
                    </tr>
                </thead>
                <tbody id="tableBody2"></tbody>
            </table>
        </div>
    </div>

    <div id="tab3" class="tab-content">
        <form id="myForm3">
            <label for="name">Monto</label>
            <input class="form-control" type="text" id="couta3" name="couta"><br>
            <label for="years">Años de inversión</label>
            <input class="form-control" type="number" id="years3" name="years" min="1" max="30" required><br>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <div id="formContent3" class="formContent">
            <h1 style="text-align:center;font-size: 1.4em;font-weight: 700;">Simulador de Inversión</h1><br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Total por Cuota</th>
                    </tr>
                </thead>
                <tbody id="tableBody3"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("active-content");
        }

        tablinks = document.getElementsByClassName("tab");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active-tab");
        }

        document.getElementById(tabName).classList.add("active-content");
        evt.currentTarget.classList.add("active-tab");
    }

    document.getElementsByClassName("tab")[0].click(); // Abre la primera pestaña por defecto

    function generarTabla(cuota, cuotas, tab, fechaInicio) {
        const tablaBody = document.getElementById(`tableBody${tab}`);
        tablaBody.innerHTML = "";
        const cuotaBasePorMes = cuota / cuotas;
        let interes = 0;
        let totalIntereses = 0;

        // Mostrar la fecha de inicio en Tab 1
        if (tab === 1) {
            document.getElementById("fechaInicial").innerText = fechaInicio;
        }


        let fecha = new Date(fechaInicio);
        fecha.setDate(fecha.getDate() + 1); // Incrementar la fecha de inicio al día siguiente
        for (let i = 1; i <= cuotas; i++) {
            if (tab === 1) {
                // Skip Sundays only for Tab 1 (Credito)
                while (fecha.getDay() === 0) { // 0 represents Sunday
                    fecha.setDate(fecha.getDate() + 1); // Skip to next day
                }

                const fechaFormatted = fecha.toISOString().split('T')[0]; // Format date as YYYY-MM-DD
                const fila = document.createElement("tr");
                const totalPorCuota = cuotaBasePorMes + interes;

                fila.innerHTML = ` 
                    <td>${i}</td>
                    <td>${fechaFormatted}</td>
                    <td>${cuotaBasePorMes.toFixed(2)} S/</td>
                    <td>${interes.toFixed(2)} S/</td>
                    <td>${totalPorCuota.toFixed(2)} S/</td>
                `;
                tablaBody.appendChild(fila);
                totalIntereses += interes;

                // Move to the next day for the next payment
                fecha.setDate(fecha.getDate() + 1);
            } else {
                // Logic for Tab 2 and Tab 3 (without dates)
                const totalPorCuota = cuotaBasePorMes + interes;
                const fila = document.createElement("tr");
                fila.innerHTML = ` 
                    <td>${i}</td>
                    <td>${cuotaBasePorMes.toFixed(2)} S/</td>
                    <td>${interes.toFixed(2)} S/</td>
                    <td>${totalPorCuota.toFixed(2)} S/</td>
                `;
                tablaBody.appendChild(fila);
            }
        }

        // Total final
        const filaTotal = document.createElement("tr");
        filaTotal.innerHTML = ` 
            <td colspan="4" style="text-align: right;"><strong>Cantidad Inicial:</strong></td>
            <td><strong>${cuota.toFixed(2)} S/</strong></td>
        `;
        tablaBody.appendChild(filaTotal);

        if (tab !== 3) {
            const filaIntereses = document.createElement("tr");
            filaIntereses.innerHTML = ` 
                <td colspan="4" style="text-align: right;"><strong>Total de Intereses:</strong></td>
                <td><strong>${totalIntereses.toFixed(2)} S/</strong></td>
            `;
            tablaBody.appendChild(filaIntereses);
        }

        const filaTotalFinal = document.createElement("tr");
        filaTotalFinal.innerHTML = ` 
            <td colspan="4" style="text-align: right;"><strong>Cantidad Total:</strong></td>
            <td><strong>${(cuota + totalIntereses).toFixed(2)} S/</strong></td>
        `;
        tablaBody.appendChild(filaTotalFinal);
    }

    // Formulario de crédito
    document.getElementById("myForm1").addEventListener("submit", function(event) {
        event.preventDefault();
        const cuota = parseFloat(document.getElementById("couta1").value);
        const cuotas = 27; // Fijo a 27 cuotas
        const fechaInicio = document.getElementById("fecha").value;
        if (isNaN(cuota) || cuota <= 0) {
            alert("Por favor, ingrese un valor válido.");
            return;
        }
        document.getElementById("formContent1").style.display = "block";
        generarTabla(cuota, cuotas, 1, fechaInicio);
    });

    // Formulario de inversión
    document.getElementById("myForm3").addEventListener("submit", function(event) {
        event.preventDefault();
        const cuota = parseFloat(document.getElementById("couta3").value);
        const cuotas = 12; // Fijo a 12 cuotas
        if (isNaN(cuota) || cuota <= 0) {
            alert("Por favor, ingrese un valor válido.");
            return;
        }
        document.getElementById("formContent3").style.display = "block";
        generarTabla(cuota, cuotas, 3, ""); // No se pasa fecha para Inversión
    });

    function generarTablaAhorro(cuota, cuotas, tab, fechaInicio) {
        const tablaBody = document.getElementById(`tableBody${tab}`);
        tablaBody.innerHTML = "";
        const cuotaBasePorDia = cuota / cuotas;  // Dividir el monto entre los días
        const interesAnual = 0.12; // 12% anual
        const interesDiario = interesAnual;  // Interés diario
        let totalIntereses = 0;

        let fecha = new Date(fechaInicio);
        fecha.setDate(fecha.getDate() + 1); // Incrementar la fecha de inicio al día siguiente
        let contadorCuotas = 0;

        // Mientras no se haya alcanzado el número de cuotas
        while (contadorCuotas < cuotas) {
            if (fecha.getDay() === 0) { // Si es domingo, saltar al siguiente día
                fecha.setDate(fecha.getDate() + 1); // Skip to next day (Monday)
                continue; // No contar domingo como cuota ni mostrarlo
            }

            const cuotaConIntereses = cuotaBasePorDia * (1 + interesDiario); // Sumar interés diario
            const fechaFormatted = fecha.toISOString().split('T')[0]; // Formatear la fecha como YYYY-MM-DD
            const fila = document.createElement("tr");

            fila.innerHTML = ` 
                <td>${contadorCuotas + 1}</td>
                <td>${fechaFormatted}</td>
                <td>${cuotaBasePorDia.toFixed(2)} S/</td>
                <td>${(cuotaBasePorDia * interesDiario).toFixed(2)} S/</td>
                <td>${cuotaConIntereses.toFixed(2)} S/</td>
            `;
            tablaBody.appendChild(fila);
            totalIntereses += cuotaBasePorDia * interesDiario;

            // Avanzar a la siguiente fecha
            fecha.setDate(fecha.getDate() + 1);
            contadorCuotas++;
        }

        // Filas adicionales con el total
        const filaTotal = document.createElement("tr");
        filaTotal.innerHTML = ` 
            <td colspan="4" style="text-align: right;"><strong>Cantidad Inicial:</strong></td>
            <td><strong>${cuota.toFixed(2)} S/</strong></td>
        `;
        tablaBody.appendChild(filaTotal);

        const filaIntereses = document.createElement("tr");
        filaIntereses.innerHTML = ` 
            <td colspan="4" style="text-align: right;"><strong>Total de Intereses:</strong></td>
            <td><strong>${totalIntereses.toFixed(2)} S/</strong></td>
        `;
        tablaBody.appendChild(filaIntereses);

        const filaTotalFinal = document.createElement("tr");
        filaTotalFinal.innerHTML = ` 
            <td colspan="4" style="text-align: right;"><strong>Cantidad Total:</strong></td>
            <td><strong>${(cuota + totalIntereses).toFixed(2)} S/</strong></td>
        `;
        tablaBody.appendChild(filaTotalFinal);
    }


    // Formulario de ahorro
    document.getElementById("myForm2").addEventListener("submit", function(event) {
        event.preventDefault();
        const cuota = parseFloat(document.getElementById("couta2").value);
        const tiempo = parseFloat(document.getElementById("years2").value); // Obtener el tiempo seleccionado (en años)
        let cuotas;

        // Calcular los días y el número de cuotas
        if (tiempo === 1) {  // 1 año
            cuotas = 313; // 313 días laborables en 1 año (excluyendo domingos)
        } else if (tiempo === 0.5) {  // 6 meses
            // Si la fecha de inicio cae en un día específico, ajustar si tiene 154 o 155 días
            const fechaInicio = new Date(document.getElementById("fecha").value);
            const isLeapYear = (fechaInicio.getFullYear() % 4 === 0 && (fechaInicio.getFullYear() % 100 !== 0 || fechaInicio.getFullYear() % 400 === 0));
            const diasEnElAño = isLeapYear ? 366 : 365;  // Si es bisiesto o no

            // Calcular los días laborables
            cuotas = 154; // Inicializamos como 154 días (aproximadamente 6 meses sin domingos)
            // Revisar si 6 meses tiene 155 días según la fecha exacta
            const mesInicio = fechaInicio.getMonth();
            if (mesInicio === 1 || mesInicio === 3 || mesInicio === 5 || mesInicio === 7 || mesInicio === 8 || mesInicio === 10 || mesInicio === 12) {
                cuotas = 155;
            }
        }

        if (isNaN(cuota) || cuota <= 0) {
            alert("Por favor, ingrese un valor válido.");
            return;
        }

        // Mostrar la tabla
        document.getElementById("formContent2").style.display = "block";
        generarTablaAhorro(cuota, cuotas, 2, document.getElementById("fecha").value);
    });

</script>

<?php require_once "parte_inferior.php" ?>
