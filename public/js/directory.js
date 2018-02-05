let dqs = (el) => { return document.querySelector(el) } // una simple funcion para abreviar document.querySelector
var drt = new Vue({
	el: '#dir', //elemento a trabajar con vue.js
	//modelo de datos de la app
	data: {
		directory: null,
		update: true,
		edit: {'name': null}
	},
	//funcion que se ejecuta al cargar el objeto de vue.js
	created: function() {
		this.getDirectory()
	},
	methods: {
		//obtener todos los contactos de la bd
		getDirectory: function(){
			let url = '/directory'
			//ejecuto la peticion ajax al controlador
			axios.get(url).then(res => {
				this.directory = res.data.dir //añado todos los contactos que me devuelve la bd
			})
		},
		//almacenar los datos de un contacto del formulario con id adddirectory
		storeDirectory: function() {
			let form = dqs('#adddirectory')
			let url = form.getAttribute('action')
			let data = new FormData(form) //agrupo todos los campos del formulario en un objeto 
			//ejecuto la peticion ajax al controlador
			axios.post(url, data).then((res) => {
				form.reset() //limpio el formulario
				$('#formadd').collapse('toggle') //se le hace toggle al collapse de bootstrap
				this.getDirectory() //refreco el modelo de datos del objeto de vue.js
				toastr.success(res.data.res) //lanzo una alerta de exito
			}, (err) => {
				let er = err.response.data.errors //obtengo los errores de la peticion
				Object.keys(er).forEach(function(key){
					toastr.error(er[key]) //lanzo las alertas por algun fallo
				})
			})
		},
		//actualizar un contacto con los datos que estan en el formulario con id updatedirectory
		updateDirectory: function() {
			let form = dqs('#updatedirectory')
			let url = form.getAttribute('action') + '/' + dqs('#ida').value //obtengo el atributo action del formulario y le agrego el id del contacto
			let data = new FormData(form) //agrupo todos los campos del formulario en un objeto 
			//ejecuto la peticion ajax al controlador
			axios.post(url, data).then((res) => {
				form.reset() //limpio el formulario
				$('#formadd').collapse('toggle') //se le hace toggle al collapse de bootstrap
				this.getDirectory() //listar todos los contactos
				toastr.success(res.data.res) //lanzo una alerta de exito
			}, (err) => {
				let er = err.response.data.errors //obtengo los errores de la peticion
				Object.keys(er).forEach(function(key){
					toastr.error(er[key]) //lanzo las alertas por algun fallo
				})
			})
		},
		deleteDirectory: function(a) {
			let form = dqs('#destroy') //formulario para eliminar
			let url = form.getAttribute('action') + '/' + a.id //obtengo la url que tiene el atributo action
			let data = new FormData(form) //obtengo los datos del formulario
			var v = this //paso los datos de vue.js a la variable v porque this en este scope es de vue.js, mas abajo this obtiene los datos de bootbox.js
			//este es un modal alert hecho con bootstrap para no hacer simplemente un alert(msm)
			bootbox.confirm({
				size: 'small',
				title: "Eliminar contacto",
				message: "¿Esta seguro de eliminar este contacto?",
				buttons: {
					cancel: {
						label: 'Cancelar'
					},
					confirm: {
						label: 'Si, estoy seguro'
					}
				},
				callback: function (result) {
					if(result){
						//ejecuto la peticion ajax al controlador
						axios.delete(url, data).then((res) => {
							toastr.success(res.data.res)
							v.getDirectory() //listo nuevamente los contactos despues de eliminar
						}, (err) => {
							let er = err.response.data.errors
							Object.keys(er).forEach(function(key){
								toastr.error(er[key]) //obtengo todos los errores de la peticion
							})
						})
					}
				}
			})	
		},
		//solo hace el toggle entre el formulario para editar y almacenar los contactos (ojo son dos formularios distintos)
		toggleForm: function() {
			this.update = true
			$('#formadd').collapse('show')
		},
		//este metodo se lanza cuando le dan clic al boton editar y coloca los datos en el formulario
		showDirectory: function(a) {
			this.update = false
			this.edit.id = a.id
			this.edit.fullname = a.fullname
			this.edit.phone = a.phone
			this.edit.email = a.email
			this.edit.address = a.address
			$('#formadd').collapse('show') //se le hace toggle al colapse
		}
	}
})