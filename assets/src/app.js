// import all require packages

const axios = require('./../node_modules/axios/dist/axios');


//  my codes
new Vue({
	el: '#app',
	data: {
		msg: 'hi from mssg',
		a: 1,
		userTypes:null,
		columns:null
	},
	methods: {
		async showUserType(e) {
			let that = this;
			e.preventDefault();
			//clearn data
			that.userTypes=null;
			let listclass=Array.from(e.srcElement.parentElement.parentElement.children).forEach(item => {
				item.children[0].classList.remove('bg-teal')
			});
			
			e.toElement.classList.add('bg-teal')
			// Make a request for a user with a given ID
			await axios.get('http://localhost/ciblog/usertype/ajaxindex/'+e.target.innerText)
				.then(function (response) {
					//if operation code was set add field edit for all user
					that.userTypes= response.data;
					if(e.target.innerText=='operation'){
						that.userTypes.map(item => {
							item.edit = 'edit'
						})
					}
					
					//get all column value
					that.columns = Object.keys(that.userTypes[0])

				})
				.catch(function (error) {
					// handle error
					console.log(error);
				})
				.finally(function () {
					// always executed
				});

		}
	},
	computed: {
		
	},
	created: function () {
		// `this` points to the vm instance
		console.log('a is: ' + this.a)
	}
})


