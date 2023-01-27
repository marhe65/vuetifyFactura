<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" >
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <meta charset="utf-8">
</head>
<body>

    <v-app id="app">
      <v-data-table :headers="headers" :item="facturas" :search="search" class="elevation-3">
        <template v-slot:top>
            <v-system-bar color="pink accent-2"></v-system-bar>
            <v-toolbar color="pink">
                <v-btn class="mx-2" :elevation="10" fab dark color="purple accent-4" @click="dialog = true">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>

                <!-- <template v-slot:extension>
                    <v-btn fab color="purple accent-4" bottom left absolute @click="dialog = ¡dialog">
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </template> -->

                <v-divider class="mx-4" inset vertical></v-divider>
                <v-toolbar-title class="white--text">Administrar facturas</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-dialog v-model="dialog">
                    <template v-slot:activator="{on}"></template>
                    <v-card>
                        <v-card-title class="indigo white-text">
                            <span class="headline">{{formTitle}}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <!-- <v-col cols="12" sm="3" md="2" lg="1">
                                        <v-text-field v-model="editado.id" label="ID"></v-text-field>
                                    </v-col> -->
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.numero_factura" type="number" step="1" min="0" label="Numero de Factura" alig></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.nombre_cliente" label="Nombre del Cliente"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.fecha" label="Fecha de Factura"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.articulo" label="Nombre del Articulo"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.cantidad" type="number" step="1" min="0" label="Cantidad"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.valor_unitario" type="number" step="1" min="0" label="Valor Unitario"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.subtotal" type="number" step="1" min="0" label="Subtotal"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.iva" type="number" step="1" min="0" label="IVA"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="2" lg="3">
                                        <v-text-field v-model="editado.total" type="number" step="1" min="0" label="Total"></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue-grey" class="ma-2 white--text" @click="cancelar">Cancelar</v-btn>
                            <v-btn color="purple accent-4" class="ma-2 white--text" @click="guardar">Guardar</v-btn>
                        </v-card-actions>
                    </v-card>                    
                </v-dialog>
            </v-toolbar>
            <!--Barra de búsqueda-->
            <v-col cols="12" sm="12">
                <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
            </v-col>
        </template>
        <!--Definir columna ACCIONES donde van los botones de Editar y Eliminar
        con el valor (item) toma la fila seleccionada-->
        <template v-slot:item.accion="{ item }">
            <v-btn class="mr-2" fab dark small color="purple" @click="editar(item)">
                <v-icon dark>mdi-pencil</v-icon>
            </v-btn>
            <v-btn class="mr-2" fab dark small color="error" @click="borrar(item)">
                <v-icon dark>mdi-delete</v-icon>
            </v-btn>
        </template>
      </v-data-table>
      <!--Mensaje de cerrar al guardar o cancelar-->
      <template>
        <div class="text-center ma-2">
            <v-snackbar v-model="snackbar">
                {{ textSnack }}
                <v-btn color="info" text @click="snackbar = false">Cerrar</v-btn>
            </v-snackbar>
        </div>
      </template>
    </v-app>
  
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.2/axios.js"></script>
  <script src="codevue.js"></script>
</body>
</html>