<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->

<?php //include_once 'bd/conexion.php';
//$objeto = new Conexion();
//$conexion = $objeto->Conectar();

//Informacion de la base de datos
$mysqli = new PDO('mysql:host=localhost;dbname=progresardatos', 'root', '');

$consulta = "SELECT * FROM clientes";
//$resultado = $conexion->prepare($consulta);
$resultado = $mysqli->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>

                    <div class="animate__animated p-6" :class="[$store.app.animation]">
                    <!-- start main content section -->
                    <div x-data="miscellaneous">
                        <div class="space-y-6">
                            <div class="panel">
                                <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">Lista de Clientes</h5>
                                <div class="relative">
                                    <div class="mb-5 sm:absolute sm:top-0 sm:mb-0 sm:ltr:right-56 sm:rtl:left-56">
                                        <div class="flex items-center">
                                            <a href="agregar_cliente.php" type="button" class="btn btn-outline-success">Agregar Cliente</a>
                                            &nbsp; &nbsp; &nbsp;
                                            <div class="theme-dropdown relative" x-data="{ columnDropdown: false }" @click.outside="columnDropdown = false">

                                                <a href="javascript:;" class="flex items-center rounded-md border border-[#e0e6ed] px-4 py-2 text-sm font-semibold dark:border-[#253b5c] dark:bg-[#1b2e4b] dark:text-white-dark" @click="columnDropdown = ! columnDropdown">
                                                    <span class="ltr:mr-1 rtl:ml-1">Columns</span>
                                                    <svg class="h-5 w-5" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>
                                                <div class="absolute top-11 z-[10] hidden w-[100px] min-w-[150px] rounded bg-white py-2 text-dark shadow ltr:left-0 rtl:right-0 dark:bg-[#1b2e4b] dark:text-white-light" :class="columnDropdown && '!block'">
                                                    <ul class="space-y-2 px-4 font-semibold">
                                                        <template x-for="(col,i) in columns" :key="i">
                                                            <li>
                                                                <div>
                                                                    <label class="cursor-pointer">
                                                                        <input type="checkbox" class="form-checkbox" :id="`chk-${i}`" :value="(i)" @change="col.hidden=  $event.target.checked,showHideColumns(i,$event.target.checked)" :checked="col.hidden">
                                                                        <span :for="`chk-${i}`" class="ltr:ml-2 rtl:mr-2" x-text="col.name"></span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div><table id="myTable1" class="whitespace-nowrap"></table>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <!-- end main content section -->
                    </div>

<script src="assets/js/highlight.min.js"></script>
<script src="assets/js/alpine-collaspe.min.js"></script>
<script src="assets/js/alpine-persist.min.js"></script>
<script defer="" src="assets/js/alpine-ui.min.js"></script>
<script defer="" src="assets/js/alpine-focus.min.js"></script>
<script defer="" src="assets/js/alpine.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/simple-datatables.js"></script>
<script>
                     document.addEventListener('alpine:init', () => {
                // main section
                Alpine.data('scrollToTop', () => ({
                    showTopButton: false,
                    init() {
                        window.onscroll = () => {
                            this.scrollFunction();
                        };
                    },

                    scrollFunction() {
                        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                            this.showTopButton = true;
                        } else {
                            this.showTopButton = false;
                        }
                    },

                    goToTop() {
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                    },
                }));

                // theme customization
                Alpine.data('customizer', () => ({
                    showCustomizer: false,
                }));

                // sidebar section
                Alpine.data('sidebar', () => ({
                    init() {
                        const selector = document.querySelector('.sidebar ul a[href="' + window.location.pathname + '"]');
                        if (selector) {
                            selector.classList.add('active');
                            const ul = selector.closest('ul.sub-menu');
                            if (ul) {
                                let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                                if (ele) {
                                    ele = ele[0];
                                    setTimeout(() => {
                                        ele.click();
                                    });
                                }
                            }
                        }
                    },
                }));

                        // header section
                        Alpine.data('miscellaneous', () => ({
                            init() {
                        const selector = document.querySelector('ul.horizontal-menu a[href="' + window.location.pathname + '"]');
                        if (selector) {
                            selector.classList.add('active');
                            const ul = selector.closest('ul.sub-menu');
                            if (ul) {
                                let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                                if (ele) {
                                    ele = ele[0];
                                    setTimeout(() => {
                                        ele.classList.add('active');
                                    });
                                }
                            }
                        }
                    },
                            columns: [
                                { name: 'ID', hidden:true },
                                { name: 'Nombres y Apellidos', hidden:true },
                                { name: 'DNI', hidden:true },
                                { name: 'RUC', hidden:false },
                                { name: 'Cal. SBS', hidden:false},
                                { name: 'Teléfono', hidden:true},
                                { name: 'Correo',hidden: false},
                                { name: 'Sexo', hidden: false},
                                { name: 'F. de Nacimiento', hidden: false},
                                { name: 'Estado Civil', hidden:false },
                                { name: 'Cónyuge', hidden:false },
                                { name: 'DNI Cónyuge', hidden:false },
                                { name: 'Dirección vivienda', hidden:true },
                                { name: 'Departamento', hidden:false},
                                { name: 'Provincia', hidden:false},
                                { name: 'Distrito',hidden: false},
                                { name: 'Ubicación', hidden: false},
                                { name: 'Referencia de Vivienda', hidden: false},
                                { name: 'Tipo Vivienda', hidden:false },
                                { name: 'Suministro', hidden:false },
                                { name: 'Ocupación', hidden:true },
                                { name: 'Dirección de Trabajo', hidden:false },
                                { name: 'Referencia de Trabajo', hidden:false},
                                { name: 'Asesor', hidden:false},
                                { name: 'Estado', hidden:false},
                                { name: 'Anotaciones', hidden:false},
                            ],

                                removeNotification(value) {
                        this.notifications = this.notifications.filter((d) => d.id !== value);
                    },

                    removeMessage(value) {
                        this.messages = this.messages.filter((d) => d.id !== value);
                    },
        
                            hideCols: [0, 3, 4, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 21, 22, 25],
                            showCols: [1, 2, 5, 12, 20, 23, 24],
                            showHideColumns(col, value) {
                                if (value) {
                                    this.showCols.push(col);
                                    this.hideCols = this.hideCols.filter((d) => d != col);
                                } else {
                                    this.hideCols.push(col);
                                    this.showCols = this.showCols.filter((d) => d != col);
                                }
                                let headers = this.datatable1.columns();
                                headers.hide(this.hideCols);
                                headers.show(this.showCols);
                            },
                            datatable1: null,
        
                            init() {
                                
                                const dynamicData = <?php echo json_encode($data); ?>;
                                let headers = this.columns.map(col => col.name);
        
                                this.datatable1 = new simpleDatatables.DataTable('#myTable1', {
        data: {
            headings: headers, // Column headers
            data: dynamicData.map(row => [
                row.id,
                row.nombres,
                row.dni,
                row.ruc,
                row.calsbs,
                row.telefono,
                row.correo,
                row.sexo,
                row.fechanacimiento,
                row.estadocivil,
                row.conyuge,
                row.dniconyuge,
                row.direcvivienda,
                row.departamento,
                row.provincia,
                row.distrito,
                row.ubic,
                row.refvivienda,
                row.tipovivenda,
                row.suministro,
                row.ocupacion,
                row.directrabajo,
                row.reftrabajo,
                row.asesor,
                row.estado,
                row.anotaciones,
            ]),
        },
        perPage: 10,
        perPageSelect: [10, 20, 30, 50, 100],
        columns: [
            {
                select: 0,
                sort: 'asc',
            },
            {
                select: 26,
                render: (data, cell, row) => {
                    return this.formatDate(data);
                },
            },
            {
                select: 9,
                render: (data, cell, row) => {
                    return `<span class="capitalize" class="${data ? 'text-success' : 'text-danger'}">${data}</span>`;
                },
            },
        ],
        firstLast: true,
        firstText:
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
        lastText:
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
        prevText:
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
        nextText:
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
        labels: {
            perPage: '{select}',
        },
        layout: {
            top: '{search}',
            bottom: '{info}{select}{pager}',
        },
    });
    
                                let cols = this.datatable1.columns();
                                cols.hide(this.hideCols);
                                cols.show(this.showCols);
                            },
                            formatDate(date) {
                                if (date) {
                                    const dt = new Date(date);
                                    const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt.getMonth() + 1;
                                    const day = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                                    return day + '/' + month + '/' + dt.getFullYear();
                                }
                                return '';
                            },
                        }));
                    });</script>                  
<!-- end main content section -->


<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>