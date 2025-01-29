<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="animate__animated p-6" :class="[$store.app.animation]">
     <?php include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

?>


                    <!-- start main content section -->
                    <div x-data="invoiceAdd">
                        <div class="flex flex-col gap-2.5 xl:flex-row">
                            <div class="mt-6 w-full xl:mt-0 xl:w-96">
                                <div class="panel mb-5">

                                    <div>
                                        
                                    </div>

                                    <div class="mt-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="monto" class="form-label">Monto</label>
                                                <input type="text" name="monto" id="monto" class="form-input w-2/3 lg:w-[250px]" style="width: 170px;">
                                            </div>
                                            <div>
                                                <label for="interes" class="form-label">Tasa de interés</label>
                                                <input type="text" name="interes" id="interes" class="form-input w-2/3 lg:w-[250px]" style="width: 170px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="periodo" class="form-label">Periodo de pago</label>
                                                <select class="form-select" name="periodo" id="periodo">
                                                   <option value="Diario">Diario</option>
                                                   <option value="Semanal">Semanal</option>
                                                   <option value="Quincenal">Quincenal</option>
                                                   <option value="Mensual">Mensual</option>
                                                   <option value="Bimestral">Bimestral</option>
                                                   <option value="Trimestral">Trimestral</option>
                                                   <option value="Medio_ano">Medio año</option>
                                                   <option value="Anual">Anual</option>
                                                </select>
                                            </div>
                                            <div>
                                               <label for="plazo" class="form-label">Cuotas</label>
                                               <input type="text" name="plazo" id="plazo" class="form-input w-2/3 lg:w-[250px]" style="width: 170px;">
                                            </div>
                                        </div>
                                    </div>


                                     <div class="mt-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="gracia" class="form-label">Tiempo de gracia</label>
                                                <input type="text" name="gracia" id="gracia" class="form-input w-2/3 lg:w-[250px]" style="width: 170px;">
                                            </div>
                                            <div>
                                                <label for="interestotal" class="form-label">Interés</label>
                                                <input type="text" name="interestotal" id="interestotal" class="form-input w-2/3 lg:w-[250px]" readonly style="width: 170px;">
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="mt-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="cuotaindividual" class="form-label">Cuota</label>
                                                <input type="text" name="cuotaindividual" id="cuotaindividual" class="form-input w-2/3 lg:w-[250px]" readonly style="width: 170px;">
                                            </div>
                                            <div>
                                                <label for="totalpagar" class="form-label">Total a pagar</label>
                                                <input type="text" name="totalpagar" id="totalpagar" class="form-input w-2/3 lg:w-[250px]" readonly style="width: 170px;">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mt-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="fechainicio" class="form-label">Inicio de pago</label>
                                                <input type="text" name="fechainicio" id="fechainicio" class="form-input w-2/3 lg:w-[250px]" readonly style="width: 170px;">
                                            </div>
                                            <div>
                                                <label for="ultimafecha" class="form-label">Fin de pago</label>
                                                <input type="text" name="ultimafecha" id="ultimafecha" class="form-input w-2/3 lg:w-[250px]" readonly style="width: 170px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-6 sm:mb-0" style="padding: 30px 0px 0px 0px;">
                                        <div class="sm:w-2/5">
                                            <button type="button" id="calcularButton" class="btn btn-primary">Calcular</button>
                                        </div>
                                    </div>
                                    <script>
document.addEventListener('DOMContentLoaded', function() {
    let calcularButton = document.getElementById('calcularButton');
    let feriados = ["01/06/2024", "05/10/2024", "21/10/2024", "25/12/2024"].map(fecha => new Date(fecha));
    calcularButton.addEventListener('click', function(e) {
        e.preventDefault();
        let monto = parseFloat(document.getElementById('monto').value);
        let plazo = parseInt(document.getElementById('plazo').value);
        let interes = parseFloat(document.getElementById('interes').value) / 100;
        let periodo = document.getElementById('periodo').value;
        let gracia = parseInt(document.getElementById('gracia').value) || 0;
        if (!validarDatos(monto, plazo, interes)) return;
        let dias_del_periodo;
        switch (periodo) {
            case 'Diario': dias_del_periodo = 1; break;
            case 'Semanal': dias_del_periodo = 7; break;
            case 'Quincenal': dias_del_periodo = 15; break;
            case 'Mensual': dias_del_periodo = 30; break;
            case 'Bimestral': dias_del_periodo = 60; break;
            case 'Trimestral': dias_del_periodo = 90; break;
            case 'Medio_ano': dias_del_periodo = 180; break;
            case 'Anual': dias_del_periodo = 365; break;
            default: dias_del_periodo = 1;
        }
        let tiempoEnMeses = Math.ceil((plazo * dias_del_periodo) / 30);
        let interesTotal = monto * interes * tiempoEnMeses;
        let totalAPagar = monto + interesTotal;
        let cuotaIndividual = totalAPagar / plazo;

        document.getElementById('totalpagar').value = "S/." + totalAPagar.toFixed(2);
        document.getElementById('cuotaindividual').value = "S/." + cuotaIndividual.toFixed(2);
        document.getElementById('interestotal').value = "S/." + interesTotal.toFixed(2);
        let fechaActual = new Date();
        let fechaInicioPago = calcularFechaInicioPago(fechaActual, dias_del_periodo, periodo, gracia);
        let fechaUltimoPago = calcularFechaFinalPago(fechaInicioPago, plazo, dias_del_periodo, periodo);
        document.getElementById('fechainicio').value = fechaInicioPago.toLocaleDateString();
        document.getElementById('ultimafecha').value = fechaUltimoPago.toLocaleDateString();
    });
    function calcularFechaInicioPago(fecha, dias_del_periodo, periodo, gracia) {
        let nuevaFecha = new Date(fecha);
        if (periodo === 'Diario') {
            nuevaFecha.setDate(nuevaFecha.getDate() + 1 + gracia);
        } else if (periodo === 'Semanal') {
            nuevaFecha.setDate(nuevaFecha.getDate() + 7 + gracia);
        } else if (periodo === 'Quincenal') {
            nuevaFecha.setDate(nuevaFecha.getDate() + 15 + gracia);
        } else if (periodo === 'Mensual') {
            nuevaFecha.setMonth(nuevaFecha.getMonth() + 1);
        } else if (periodo === 'Bimestral') {
            nuevaFecha.setMonth(nuevaFecha.getMonth() + 2);
        } else if (periodo === 'Trimestral') {
            nuevaFecha.setMonth(nuevaFecha.getMonth() + 3);
        } else if (periodo === 'Medio_ano') {
            nuevaFecha.setMonth(nuevaFecha.getMonth() + 6);
        } else if (periodo === 'Anual') {
            nuevaFecha.setFullYear(nuevaFecha.getFullYear() + 1);
        } else {
            nuevaFecha.setDate(nuevaFecha.getDate() + dias_del_periodo);
        }
        return fechaHabil(nuevaFecha);
    }
    function calcularFechaFinalPago(fechaInicio, plazo, dias_del_periodo, periodo) {
        let fechaFinal = new Date(fechaInicio);
        for (let i = 0; i < plazo - 1; i++) {
            if (periodo === 'Diario') {
                fechaFinal.setDate(fechaFinal.getDate() + 1);
            } else if (periodo === 'Semanal') {
                fechaFinal.setDate(fechaFinal.getDate() + 7);
            } else if (periodo === 'Quincenal') {
                fechaFinal.setDate(fechaFinal.getDate() + 15);
            } else if (periodo === 'Mensual') {
                fechaFinal.setMonth(fechaFinal.getMonth() + 1);
            } else if (periodo === 'Bimestral') {
                fechaFinal.setMonth(fechaFinal.getMonth() + 2);
            } else if (periodo === 'Trimestral') {
                fechaFinal.setMonth(fechaFinal.getMonth() + 3);
            } else if (periodo === 'Medio_ano') {
                fechaFinal.setMonth(fechaFinal.getMonth() + 6);
            } else if (periodo === 'Anual') {
                fechaFinal.setFullYear(fechaFinal.getFullYear() + 1);
            } else {
                fechaFinal.setDate(fechaFinal.getDate() + dias_del_periodo);
            }
            fechaFinal = fechaHabil(fechaFinal);
        }
        return fechaFinal;
    }
    function fechaHabil(fecha) {
        while (esDomingoOferiado(fecha)) {
            fecha.setDate(fecha.getDate() + 1);
        }
        return fecha;
    }
    function esDomingoOferiado(fecha) {
        if (fecha.getDay() === 0) return true; // Domingo

        let dateString = fecha.toLocaleDateString();
        for (let feriado of feriados) {
            if (feriado.toLocaleDateString() === dateString) {
                return true;
            }
        }
        return false;
    }
    function validarDatos(monto, plazo, interes) {
        if (isNaN(monto) || monto <= 0) {
            alert("Por favor, ingrese un monto válido.");
            return false;
        }
        if (isNaN(plazo) || plazo <= 0) {
            alert("Por favor, ingrese un plazo válido.");
            return false;
        }
        if (isNaN(interes) || interes <= 0) {
            alert("Por favor, ingrese una tasa de interés válida.");
            return false;
        }
        return true;
    }
});
</script>
                                    
                                </div>
                            </div>


                            <div class="panel flex-1 px-0 py-6 ltr:lg:mr-6 rtl:lg:ml-6">

                                <div class="mt-8 px-4">
                                    <div class="flex flex-col justify-between lg:flex-row">
                                        <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Name</label>
                                                <input id="reciever-name" type="text" name="reciever-name" class="form-input flex-1" x-model="params.to.name" placeholder="Enter Name">
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-email" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Email</label>
                                                <input id="reciever-email" type="email" name="reciever-email" class="form-input flex-1" x-model="params.to.email" placeholder="Enter Email">
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Address</label>
                                                <input id="reciever-address" type="text" name="reciever-address" class="form-input flex-1" x-model="params.to.address" placeholder="Enter Address">
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-number" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Phone Number</label>
                                                <input id="reciever-number" type="text" name="reciever-number" class="form-input flex-1" x-model="params.to.phone" placeholder="Enter Phone Number">
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-1/2">
                                            <div class="mt-4 flex items-center">
                                                <label for="acno" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Account Number</label>
                                                <input id="acno" type="text" name="acno" class="form-input flex-1" x-model="params.bankInfo.no" placeholder="Enter Account Number">
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="bank-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Bank Name</label>
                                                <input id="bank-name" type="text" name="bank-name" class="form-input flex-1" x-model="params.bankInfo.name" placeholder="Enter Bank Name">
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="swift-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">SWIFT Number</label>
                                                <input id="swift-code" type="text" name="swift-code" class="form-input flex-1" x-model="params.bankInfo.swiftCode" placeholder="Enter SWIFT Number">
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="iban-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">IBAN Number</label>
                                                <input id="iban-code" type="text" name="iban-code" class="form-input flex-1" x-model="params.bankInfo.ibanNo" placeholder="Enter IBAN Number">
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="country" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Country</label>
                                                <select id="country" name="country" class="form-select flex-1" x-model="params.bankInfo.country">
                                                    <option value="">Choose Country</option>
                                                    <option value="United States">United States</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="New-Zealand">New Zealand</option>
                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="American-Samoa">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Antigua Barbuda">Antigua &amp; Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bosnia">Bosnia &amp; Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British">British Virgin Islands</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Cape">Cape Verde</option>
                                                    <option value="Cayman">Cayman Islands</option>
                                                    <option value="Central-African">Central African Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Costa-Rica">Costa Rica</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czechia">Czechia</option>
                                                    <option value="Côte">Côte d'Ivoire</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican">Dominican Republic</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El-Salvador">El Salvador</option>
                                                    <option value="Equatorial-Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guernsey">Guernsey</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong-Kong">Hong Kong SAR China</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macedonia">Macedonia</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar (Burma)</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="North-Korea">North Korea</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestinian">Palestinian Territories</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Puerto">Puerto Rico</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russia">Russia</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="Réunion">Réunion</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="San-Marino">San Marino</option>
                                                    <option value="Saudi-Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra-Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon-Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South-Africa">South Africa</option>
                                                    <option value="South-Korea">South Korea</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri-Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="Sao-Tome-and-Principe">São Tomé &amp; Príncipe</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Timor-Leste">Timor-Leste</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad-and-Tobago">Trinidad &amp; Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="UAE">United Arab Emirates</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <div class="table-responsive">
                                        <table>
                                            <tbody>
                                                <template x-if="items.length <= 0">
                                                    <tr>
                                                        <td colspan="5" class="!text-center font-semibold">No Item Available</td>
                                                    </tr>
                                                </template>
                                                <template x-for="(item, i) in items" :key="i">
                                                    <tr class="border-b border-[#e0e6ed] align-top dark:border-[#1b2e4b]">
                                                        <td>
                                                            <input type="text" class="form-input min-w-[200px]" placeholder="Enter Item Name" x-model="item.title">
                                                            <textarea class="form-textarea mt-4" placeholder="Enter Description" x-model="item.description"></textarea>
                                                        </td>
                                                        <td><input type="number" class="form-input w-32" placeholder="Quantity" x-model="item.quantity"></td>
                                                        <td><input type="text" class="form-input w-32" placeholder="Price" x-model="item.amount"></td>
                                                        <td x-text="`$${item.amount * item.quantity}`"></td>
                                                        <td>
                                                            <button type="button" @click="removeItem(item)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end main content section -->

                </div>
<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>