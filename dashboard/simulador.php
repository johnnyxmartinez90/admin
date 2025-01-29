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
<!-- start main content section -->
<div class="content">
    <br>
    <div class="tabs">
        <div class="tab" onclick="openTab(event, 'tab1')">
            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                <path opacity="0.5" d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z" stroke="currentColor" stroke-width="1.5"></path>
                <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            </svg> Crédito
        </div>
        <div class="tab" onclick="openTab(event, 'tab2')">
            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                <path d="M12 6V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                <path d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            </svg> Ahorro
        </div>
        <div class="tab" onclick="openTab(event, 'tab3')">
            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5"></ellipse>
            </svg> Inversión
        </div>
    </div>

    <div id="tab1" class="tab-content">
        <form id="myForm1">
            <h1 style="text-align:center;font-size: 1.4em;font-weight: 700;">Simulador de Credito</h1>
            <label for="name">Monto Total</label>
            <input class="form-control" type="text" id="couta1" name="couta" required><br>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <div id="formContent1" class="formContent">
            <h1 style="text-align:center;font-size: 1.4em;font-weight: 700;">Simulador de crédito</h1><br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
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
            <label for="years">Años a pagar</label>
            <input class="form-control" type="number" id="years2" name="years" min="1" max="30" required><br>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <div id="formContent2" class="formContent">
            <h1 style="text-align: center;">Simulador de ahorro</h1><br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
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
            <label for="years">Años de inversion</label>
            <input class="form-control" type="number" id="years3" name="years" min="1" max="30" required><br>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <div id="formContent3" class="formContent">
            <h1 style="text-align:center;font-size: 1.4em;font-weight: 700;">Simulador de Inversion</h1><br>
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

    function generarTabla(cuota, cuotas, tab) {
        const tablaBody = document.getElementById(`tableBody${tab}`);
        tablaBody.innerHTML = "";
        const cuotaBasePorMes = cuota / cuotas;
        let interes = 0;
        let totalIntereses = 0;

        if (tab === 1 || tab === 2) {
            // Para los tab1 (Credito) y tab2 (Ahorro)
            interes = cuotaBasePorMes * 0.1; // Intereses del 10%
        }

        for (let i = 1; i <= cuotas; i++) {
            const fila = document.createElement("tr");
            const totalPorCuota = cuotaBasePorMes + interes;

            if (tab === 3) {
                fila.innerHTML = `
                    <td>${i}</td>
                    <td>${totalPorCuota.toFixed(2)} S/</td>
                `;
            } else {
                fila.innerHTML = `
                    <td>${i}</td>
                    <td>${cuotaBasePorMes.toFixed(2)} S/</td>
                    <td>${interes.toFixed(2)} S/</td>
                    <td>${totalPorCuota.toFixed(2)} S/</td>
                `;
            }

            tablaBody.appendChild(fila);
            totalIntereses += interes;
        }

        // Total final
        const filaTotal = document.createElement("tr");
        filaTotal.innerHTML = `
            <td colspan="3" style="text-align: right;"><strong>Cantidad Inicial:</strong></td>
            <td><strong>${cuota.toFixed(2)} S/</strong></td>
        `;
        tablaBody.appendChild(filaTotal);

        if (tab !== 3) {
            const filaIntereses = document.createElement("tr");
            filaIntereses.innerHTML = `
                <td colspan="3" style="text-align: right;"><strong>Total de Intereses:</strong></td>
                <td><strong>${totalIntereses.toFixed(2)} S/</strong></td>
            `;
            tablaBody.appendChild(filaIntereses);
        }

        const filaTotalFinal = document.createElement("tr");
        filaTotalFinal.innerHTML = `
            <td colspan="3" style="text-align: right;"><strong>Cantidad Total:</strong></td>
            <td><strong>${(cuota + totalIntereses).toFixed(2)} S/</strong></td>
        `;
        tablaBody.appendChild(filaTotalFinal);
    }

    // Formulario de crédito
    document.getElementById("myForm1").addEventListener("submit", function(event) {
        event.preventDefault();
        const cuota = parseFloat(document.getElementById("couta1").value);
        const cuotas = 27; // Fijo a 27 cuotas
        if (isNaN(cuota) || cuota <= 0) {
            alert("Por favor, ingrese un valor válido.");
            return;
        }
        document.getElementById("formContent1").style.display = "block";
        generarTabla(cuota, cuotas, 1);
    });

    // Formulario de ahorro
    document.getElementById("myForm2").addEventListener("submit", function(event) {
        event.preventDefault();
        const cuota = parseFloat(document.getElementById("couta2").value);
        const cuotas = parseInt(document.getElementById("years2").value) * 12; // Convertir años en meses
        if (isNaN(cuota) || cuota <= 0 || cuotas <= 0) {
            alert("Por favor, ingrese un valor válido.");
            return;
        }
        document.getElementById("formContent2").style.display = "block";
        generarTabla(cuota, cuotas, 2);
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
        generarTabla(cuota, cuotas, 3);
    });
</script>

<?php require_once "parte_inferior.php" ?>
