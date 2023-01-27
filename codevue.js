var url = "bd/crud.php";

new Vue({
    el:'#app',
    vuetify: new Vuetify(),
    data: () =>({
        search:'',
        snackbar: false,
        textSnack: 'texto del snackbar',
        dialog: false,
        headers: [
            {
                text:'ID', 
                align:'center', 
                sorteable:false, 
                value:'id',
            },
            {text:'Número de factura', value:'numero_factura'},
            {text:'Nombre del Cliente', value:'nombre_cliente'},
            {text:'Fecha', value:'fecha'},
            {text:'Nombre del Artículo', value:'articulo'},
            {text:'Cantidad', value:'cantidad'},
            {text:'Valor Unitario', value:'valor_unitario'},
            {text:'Subtotal', value:'subtotal'},
            {text:'IVA', value:'iva'},
            {text:'Total', value:'total'},
            {text:'ACCIONES', value:'accion', sorteable:false},
        ],
        facturas: [],
        editedIndex: -1,
        editado:{
            id: 0,
            numero_factura: 0,
            nombre_cliente: '',
            fecha: '',
            articulo: '',
            cantidad: 0,
            valor_unitario: 0,
            subtotal: 0,
            iva: 0,
            total: 0,
        },
        defaultItem:{
            id: 0,
            numero_factura: 0,
            nombre_cliente: '',
            fecha: '',
            articulo: '',
            cantidad: 0,
            valor_unitario: 0,
            subtotal: 0,
            iva: 0,
            total: 0,
        },
    }),
    computed:{//modifico el titulo del popup para cuando sea registro o edición
        formTitle(){
            return this.editedIndex === -1 ? 'Nuevo registro' : 'Editar registro'
        },
    },

    watch:{
        dialog(val){
            val || this.cancelar()
        },
    },

    created(){
        this.listarFacturas()
    },

    methods:{
        listarFacturas:function(){
            axios.post(url,{opcion:4}).then(response => {
                this.facturas = response.data;
            });
        },
        registroFactura:function(){
            axios.post(url,{opcion:1, numero_factura:this.numero_factura, nombre_cliente:this.nombre_cliente, 
            fecha:this.fecha, articulo:this.articulo, cantidad:this.cantidad, valor_unitario:this.valor_unitario,
            subtotal:this.subtotal, iva:this.iva, total:this.total}).then(response => {
                this.listarFacturas();
            });
            this.numero_factura=0,
            this.nombre_cliente='',
            this.fecha='',
            this.articulo='',
            this.cantidad=0,
            this.valor_unitario=0,
            this.subtotal=0,
            this.iva=0,
            this.total=0
        },
        editarFactura:function(id,numero_factura,nombre_cliente,fecha,articulo,cantidad,valor_unitario,subtotal,iva,total){
                axios.post(url,{opcion:2, id:id, numero_factura:numero_factura, nombre_cliente:nombre_cliente, fecha:fecha,
                articulo:articulo, cantidad:cantidad, valor_unitario:valor_unitario, subtotal:subtotal, iva:iva, total:total})
                .then(response => {
                    this.listarFacturas();
                });
        },
        borrarFactura:function(id){
            axios.post(url,{opcion:3, id:id}).then(response =>{
                this.listarFacturas();
            });
        },
        editar(item){
            this.editedIndex = this.facturas.indexOf(item)
            this.editado = object.assign({}, item)
            this.dialog = true
            console.log()
        },
        borrar(item){
            const index = this.facturas.indexOf(item)
            var r = confirm('¿Está seguro de eliminar el registro?');
            if(r == true){
                this.borrarFactura(this.facturas[index].id)
                this.snackbar = true
                this.textSnack = 'Se elmininó el registro'
            }else{
                this.snackbar = true
                this.textSnack = 'Solicitud cancelada'
            }
        },
        cancelar(){
            this.dialog = false
            this.editado = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        },
        guardar(){
            if(this.editedIndex > -1){//Guarda si es edición
                this.id = this.editado.id
                this.numero_factura=editado.numero_factura
                this.nombre_cliente=editado.nombre_cliente
                this.fecha=editado.fecha
                this.articulo=editado.articulo
                this.cantidad=editado.cantidad
                this.valor_unitario=editado.valor_unitario
                this.subtotal=editado.subtotal
                this.iva=editado.iva
                this.total=editado.total
                this.snackbar = true
                this.textSnack = 'Actualización exitosa...!!'
                this.editarFactura(this.id,this.numero_factura,this.nombre_cliente,this.fecha,
                    this.articulo,this.cantidad,this.valor_unitario,this.subtotal,this.iva,this.total)
            }else{//Guarda si es registro
                //verificamos que los campos no estén vacíos
                if(this.editado.numero_factura == 0 || this.nombre_cliente == '' || this.fecha == '' ||
                this.articulo == '' || this.cantidad == 0 || this.valor_unitario == 0 || this.subtotal == 0
                || this.iva == 0 || this.total == 0){
                    this.snackbar = true
                    this.textSnack = 'Datos incompletos...!!'
                }else{
                    this.numero_factura=editado.numero_factura
                    this.nombre_cliente=editado.nombre_cliente
                    this.fecha=editado.fecha
                    this.articulo=editado.articulo
                    this.cantidad=editado.cantidad
                    this.valor_unitario=editado.valor_unitario
                    this.subtotal=editado.subtotal
                    this.iva=editado.iva
                    this.total=editado.total
                    this.snackbar = true
                    this.textSnack = 'Registro Exitoso...!!'
                    this.registroFactura()
                }
            }
            this.cancelar()
        },
    }
});