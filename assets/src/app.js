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
		showUserType(e) {
			e.preventDefault();
			let listclass=Array.from(e.srcElement.parentElement.parentElement.children).forEach(item => {
				item.children[0].classList.remove('bg-teal')
			});
			
			e.toElement.classList.add('bg-teal')
			let that = this;
			// Make a request for a user with a given ID
			axios.get('http://localhost/ciblog/usertype/ajaxindex/'+e.target.innerText)
				.then(function (response) {
					that.columns = Object.keys(response.data[0])
					that.userTypes= response.data;
					
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


